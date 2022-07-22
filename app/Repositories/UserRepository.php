<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version September 9, 2021, 12:46 pm UTC
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type',
        'gender',
        'is_active',
        'email_verified_at',
        'token',
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
        return User::class;
    }

    /**
     * @param $input
     *
     * @return Model
     */
    public function storeUser($input)
    {
        $userInput = Arr::only($input, $this->model->getFillable());
        $userInput['password'] = Hash::make($userInput['password']);
        $userInput['email_verified_at'] = Carbon::now();
        /** @var User $user */
        $user = $this->create($userInput);
        if (isset($input['photo']) && $input['photo']) {
            $user->addMedia($input['photo'])->toMediaCollection(User::IMAGE_PATH,
                config('app.media_disc'));
        }

        return $user;
    }

    /**
     * @param $id
     * @param $input
     *
     * @return User
     */
    public function updateUser($id, $input)
    {
        $userInput = Arr::only($input, $this->model->getFillable());
        /** @var User $user */
        $user = $this->update($userInput, $id);
        if (isset($input['photo']) && $input['photo']) {
            $user->clearMediaCollection(User::IMAGE_PATH);
            $user->addMedia($input['photo'])->toMediaCollection(User::IMAGE_PATH,
                config('app.media_disc'));
        }

        return $user;
    }
}
