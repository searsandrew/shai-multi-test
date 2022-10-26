<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public function donor() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    public function recipient() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Recipoent::class);
    }
}
