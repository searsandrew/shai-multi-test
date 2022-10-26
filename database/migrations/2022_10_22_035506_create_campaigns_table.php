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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('slug');
            $table->bigInteger('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->string('name');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->boolean('toggle_image')->default(false);
            $table->boolean('toggle_family')->default(false);
            $table->boolean('toggle_privacy')->default(false);
            $table->boolean('toggle_transaction_email')->default(false);
            $table->boolean('toggle_instruction_email')->default(false);
            $table->boolean('toggle_reminder_email')->default(false);
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
        Schema::dropIfExists('campaigns');
    }
};
