<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Dyrynda\Database\Support\GeneratesUuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Donor extends Model implements AuditableContract
{
    use Auditable, GeneratesUuid, HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email'];

    public function donations() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function selections()
    {
        return $this->donations()->where('status', 'selected')->get();
    }

    public function donationRecipient() : \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Recipient::class, Donation::class);
    }
}
