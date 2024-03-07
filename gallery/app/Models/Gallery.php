<?php

namespace App\Models;

use App\Models\Image;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;
    protected $table = 'galleries';
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
}
