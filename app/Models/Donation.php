<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Dyrynda\Database\Support\GeneratesUuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Donation extends Model implements AuditableContract
{
    use Auditable, GeneratesUuid, HasFactory, SoftDeletes;

    protected $fillable = ['donor_id', 'recipient_id', 'selected_at'];


    public function donor() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    public function recipient() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Recipoent::class);
    }
}
