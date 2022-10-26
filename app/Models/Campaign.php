<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Dyrynda\Database\Support\GeneratesUuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;
use Plank\Metable\Metable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Carbon\Carbon;

class Campaign extends Model implements AuditableContract
{
    use Auditable, GeneratesUuid, HasFactory, HasSlug, Metable, SoftDeletes;

    protected $fillable = ['name', 'started_at', 'ended_at', 'toggle_image', 'toggle_family', 'toggle_privacy', 'toggle_transaction_email', 'toggle_instruction_email', 'toggle_reminder_email'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    protected function startedAt() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value),
            set: fn ($value) => Carbon::parse($value),
        );
    }

    protected function endedAt() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value),
            set: fn ($value) => Carbon::parse($value),
        );
    }

    public function organization() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function recipients() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Recipient::class);
    }
}

