<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    public function donations() : \Illuminate\Database\Eloquent\Relationships\HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function donationRecipient() : \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Recipient::class, Donation::class);
    }
}
