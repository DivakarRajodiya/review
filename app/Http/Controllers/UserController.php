<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Facades\DataTables;

class UserController extends AppBaseController
{
    /** @var  UserRepository $userRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
            return DataTables::of((new UserDataTable())->get())->make(true);
        }

        return view('users.index');
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return RedirectResponse
     * @throws \Throwable
     *
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $this->userRepository->storeUser($input);
        Flash::success('User created successfully.');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     *
     * @param User $user
     *
     * @return RedirectResponse
     * @throws \Throwable
     *
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();
        $this->userRepository->updateUser($user->id, $input);
        Flash::success('User updated successfully.');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return mixed
     * @throws \Exception
     *
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendSuccess('User deleted successfully.');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function changeIsActive(Request $request)
    {
        $input = $request->all();
        $user = User::find($input['id']);
        $user->update(['is_active' => !$user->is_active]);

        return $this->sendSuccess('User update successfully');
    }

    /**
     * @param Request $request
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function updateProfile(Request $request, User $user)
    {
        $input = $request->all();
        $this->userRepository->updateUser($user->id, $input);

        return $this->sendSuccess('Profile update successfully.');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        if (Hash::check($input['password_current'], $user->password)) {
            $request->validate([
                'password' => ['required'],
                'confirm_password' => ['same:password'],
            ]);
            $user->update(['password' => Hash::make($input['password'])]);
        }

        return $this->sendSuccess('Password update successfully.');
    }
}
