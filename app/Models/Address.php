<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Dyrynda\Database\Support\GeneratesUuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Address extends Model implements AuditableContract
{
    use Auditable, GeneratesUuid, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'unit', 'city', 'state', 'zipcode', 'phone', 'addressable_id', 'addressable_type'];

    /**
     * Get the owning addressable model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable() : \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
