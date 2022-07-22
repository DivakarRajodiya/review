<?php

namespace App\DataTables;

use App\Models\User;

class ReviewTables
{
    /**
     * @return User
     */
    public function get()
    {
        /** @var User $query */
        $query = User::where('rating', '!=', null)->where('review_message', '!=', null)->get();

        return $query;
    }
}
