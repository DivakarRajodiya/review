<?php

namespace App\Http\Controllers;

use App\DataTables\ContactUsDataTable;
use App\Models\ContactUs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new ContactUsDataTable())->get())->make(true);
        }

        return view('contact-us.index');
    }

    /**
     * @param ContactUs $contactUs
     *
     * @return JsonResponse
     */
    public function destroy(ContactUs $contactUs)
    {
        $contactUs->delete();

        return $this->sendSuccess('Contact Us deleted successfully.');
    }
}
