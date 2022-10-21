<?php

namespace App\DataTables;

use App\Models\ContactUs;

class ContactUsDataTable
{
    /**
     * @return ContactUs
     */
    public function get()
    {
        /** @var ContactUs $query */
        $query = ContactUs::query();

        return $query;
    }
}
