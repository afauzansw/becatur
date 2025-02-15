<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    protected $appends = [
        'qris_image',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('qris_image');
    }

    public function getQrisImageAttribute(): string|null
    {
        return $this->getFirstMediaUrl('qris_image');
    }
}
