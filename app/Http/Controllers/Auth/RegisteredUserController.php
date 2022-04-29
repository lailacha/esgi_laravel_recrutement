<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Media;
use App\Helpers\FileHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\MediaService;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\UserProfileRequest;

class RegisteredUserController extends Controller
{
    private MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
            'cv' => 'file|mimes:pdf',
            'role' => 'required',
            'avatar' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('avatar')) {
           $avatar = $this->mediaService->saveRessourceGetInstance($request, 'avatar', 'avatar');
        }

        if($request->hasFile('cv')) {
            $cv = $this->mediaService->saveRessourceGetInstance($request, 'cv', 'cv');
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar_id' => $avatar->id ?? null,
            'cv_id' => $cv->id ?? null,
        ]);

        $user->assignRole($request->role);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function downloadCV(User $user)
    {
        return response()->download(storage_path('app/public/cv/'.$user->cv->chemin), $user->cv->nom);
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('roles', 'user'));
    }

    public function update(User $user, UserProfileRequest $request)
    {

        if($request->hasFile('avatar')) {
           $avatar = $this->mediaService->saveRessourceGetInstance($request,'avatar','avatar');

           $user->avatar_id = $avatar->id;
        }

        if ($request->hasFile('cv')) {
            $cv = $this->mediaService->saveRessourceGetInstance($request,'cv', 'cv');
            $user->cv_id = $cv->id;
        }

        if($request->has('firstname')) {
            $user->firstname = $request->firstname;
        }

        if($request->has('lastname')) {
            $user->lastname = $request->lastname;
        }

        if($request->has('role') && Auth::user()->hasRole('admin')) {
            $user->assignRole($request->role);
        }

        $user->update();

        return redirect()->back()->withSuccess('Modification validée!');


    }


}
