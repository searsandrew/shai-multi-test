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
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Organization extends Model implements AuditableContract
{
    use Auditable, GeneratesUuid, HasFactory, HasSlug, Metable, SoftDeletes;

    protected $fillable = ['name', 'tax_id', 'organization_logo_path'];

    protected $appends = [
        'organization_logo_url',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getOrganizationLogoUrlAttribute()
    {
        return $this->organization_logo_path
                    ? Storage::disk('public')->url($this->organization_logo_path)
                    : $this->defaultOrganizationLogoUrl();
    }

    public function getRouteKeyName() : string
    {
        return 'slug';
    }

    public function address() : \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function users() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function updateOrganizationLogo(UploadedFile $logo)
    {
        tap($this->organization_logo_path, function ($previous) use ($logo) {
            $this->forceFill([
                'organization_logo_path' => $logo->storePublicly(
                    'organization-logos', ['disk' => 'public']
                ),
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }

    public function deleteProfilePhoto()
    {
        if (is_null($this->organization_logo_path)) {
            return;
        }

        Storage::disk('public')->delete($this->organization_logo_path);

        $this->forceFill([
            'organization_logo_path' => null,
        ])->save();
    }

    protected function defaultOrganizationLogoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }
}