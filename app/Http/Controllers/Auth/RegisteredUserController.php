<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Helpers\FileHelper;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
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
            'avatar' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user_id = count(User::all()) + 1;

        if($request->hasFile('avatar')) {
            $avatarName = $user_id."_avatar_".Str::random(20);

            $request->file('avatar')->storeAs('avatar', $avatarName.'.' . $request->file('avatar')->getClientOriginalExtension(), 'public');

            $avatar = Media::create([
                'chemin' =>  $avatarName.'.' . $request->file('avatar')->getClientOriginalExtension(),
                'nom' =>  $avatarName,
                "extension" => $request->file('avatar')->getClientOriginalExtension(),
                'taille_en_ko' => FileHelper::convertByteToKo($request->file('avatar')->getSize()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        if($request->hasFile('cv')) {

            $cvName = $user_id."_cv_".Str::random(20);
            $request->file('cv')->storeAs('cv', $cvName.'.' . $request->file('cv')->getClientOriginalExtension(), 'public');

            $cv = Media::create([
                'chemin' =>  $cvName. '.' . $request->file('cv')->getClientOriginalExtension(),
                'nom' =>  $cvName,
                "extension" => $request->file('cv')->getClientOriginalExtension(),
                'taille_en_ko' => FileHelper::convertByteToKo($request->file('cv')->getSize()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar_id' => $avatar->id ?? null,
            'cv_id' => $cv->id ?? null,
        ]);

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


}
