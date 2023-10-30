<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Destination extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function destinationDetails()
    {
        return $this->hasOne(DestinationDetail::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'destination_has_facilities', 'destination_id', 'facility_id')
            ->withPivot('status', 'quantity', 'description');
    }
}
