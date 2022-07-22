<?php

namespace App\DataTables;

use App\Models\User;

class UserDataTable
{
    /**
     * @return User
     */
    public function get()
    {
        /** @var User $query */
        $query = User::query()->where('user_type', '=', User::USER);

        return $query;
    }
}
