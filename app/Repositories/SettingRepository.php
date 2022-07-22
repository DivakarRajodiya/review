<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Arr;

/**
 * Class SettingRepository
 */
class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'value',
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
        return Setting::class;
    }

    /**
     * @param array $input
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function settingUpdate($input)
    {
        $inputArr = Arr::except($input, ['_token']);
        foreach ($inputArr as $key => $value) {
            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (!$setting) {
                continue;
            }

            $setting->update(['value' => $value]);
            if (in_array($key, ['logo']) && !empty($value)) {
                $setting->clearMediaCollection(Setting::IMAGE_PATH);
                $media = $setting->addMedia($value)->toMediaCollection(Setting::IMAGE_PATH,
                    config('app.media_disc'));
                $setting->update(['value' => $media->getUrl()]);
            }
        }

        return true;
    }
}
