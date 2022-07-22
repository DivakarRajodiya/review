<?php

namespace App\Repositories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class BannerRepository
 * @package App\Repositories
 * @version September 9, 2021, 12:46 pm UTC
 */
class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Banner::class;
    }

    /**
     * @param $input
     *
     * @return Model
     */
    public function storeBanner($input)
    {
        $bannerInput = Arr::only($input, $this->model->getFillable());
        /** @var Banner $banner */
        $banner = Banner::create($bannerInput);
        if (isset($input['photo']) && $input['photo']) {
            $banner->addMedia($input['photo'])->toMediaCollection(Banner::IMAGE_PATH,
                config('app.media_disc'));
        }

        return $banner;
    }

    /**
     * @param $id
     * @param $input
     *
     * @return Banner
     */
    public function updateBanner($id, $input)
    {
        $bannerInput = Arr::only($input, $this->model->getFillable());
        /** @var Banner $banner */
        $banner = Banner::find($id);
        $banner->update($bannerInput);

        if (isset($input['photo']) && $input['photo']) {
            $banner->clearMediaCollection(Banner::IMAGE_PATH);
            $banner->addMedia($input['photo'])->toMediaCollection(Banner::IMAGE_PATH,
                config('app.media_disc'));
        }

        return $banner;
    }
}
