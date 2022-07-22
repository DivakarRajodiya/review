<?php

namespace App\MediaLibrary;

use App\Models\Banner;
use App\Models\Setting;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 */
class CustomPathGenerator implements PathGenerator
{
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'thumbnails/';
    }

    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        $path = '{PARENT_DIR}' . DIRECTORY_SEPARATOR . $media->id . DIRECTORY_SEPARATOR;

        switch ($media->collection_name) {
            case User::IMAGE_PATH:
                return str_replace('{PARENT_DIR}', User::IMAGE_PATH, $path);
            case Banner::IMAGE_PATH:
                return str_replace('{PARENT_DIR}', Banner::IMAGE_PATH, $path);
            case Setting::IMAGE_PATH:
                return str_replace('{PARENT_DIR}', Setting::IMAGE_PATH, $path);
            case 'default' :
                return '';
        }
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'rs-images/';
    }
}
