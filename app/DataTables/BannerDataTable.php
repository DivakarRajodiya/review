<?php

namespace App\DataTables;

use App\Models\Banner;

class BannerDataTable
{
    /**
     * @return Banner
     */
    public function get()
    {
        /** @var Banner $query */
        $query = Banner::query();

        return $query;
    }
}
