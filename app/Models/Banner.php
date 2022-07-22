<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const IMAGE_PATH = 'banners';


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    public $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    protected $appends = ['image_url'];

    /**
     * @return |null
     */
    public function getImageUrlAttribute()
    {
        $media = $this->getMedia(self::IMAGE_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return null;
    }
}
