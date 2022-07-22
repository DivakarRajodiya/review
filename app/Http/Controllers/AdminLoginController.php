<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.login');
    }

    /**
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user = User::where('email', $input['email'])->first();
        if ($user){
            Auth::login($user);

            return redirect(route('admin.dashboard'));
        }

        return redirect()->back();
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
