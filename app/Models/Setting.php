<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const IMAGE_PATH = 'settings';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'value' => 'required',
    ];

    public $table = 'settings';

    public $fillable = [
        'key',
        'value',
    ];
    protected $appends = ['logo_url'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string',
    ];

    /**
     * @return |null
     */
    public function getLogoUrlAttribute()
    {
        $media = $this->getMedia(self::IMAGE_PATH);
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return null;
    }
}
