<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donor_id')->unsigned();
            $table->foreign('donor_id')->references('id')->on('donors');
            $table->bigInteger('recipient_id')->unsigned();
            $table->foreign('recipient_id')->references('id')->on('recipients');
            $table->datetime('selected_at');
            $table->enum('status', ['selected','confirmed','reminded','recieved','retracted'])->default('selected');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
};
