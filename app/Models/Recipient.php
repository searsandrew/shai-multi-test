<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Dyrynda\Database\Support\GeneratesUuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Plank\Metable\Metable;
use Spatie\Tags\HasTags;

class Recipient extends Model implements AuditableContract
{
    use Auditable, GeneratesUuid, HasFactory, HasTags, Metable, SoftDeletes;

    protected $fillable = ['ref_id', 'internal_ref_slug', 'family', 'name', 'description'];

    public function campaign() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
