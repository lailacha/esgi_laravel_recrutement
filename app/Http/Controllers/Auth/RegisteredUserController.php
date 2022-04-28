<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\User;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
            'cv' => 'file|mimes:pdf',
            'avatar' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user_id = count(User::all()) + 1;

        if($request->hasFile('avatar')) {

            $request->file('avatar')->storeAs('avatar', $request->name . '.' . $request->file('avatar')->getClientOriginalExtension());

            $avatar = Media::create([
                'chemin' =>  $user_id . '.' . $request->file('avatar')->getClientOriginalExtension(),
                'nom' =>  $user_id ."_avatar_".Str::random(20),
                "extension" => $request->file('avatar')->getClientOriginalExtension(),
                'taille_en_ko' => FileHelper::convertByteToKo($request->file('avatar')->getSize()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if($request->hasFile('cv')) {

        $request->file('cv')->storeAs('cv', $request->name . '.' . $request->file('cv')->getClientOriginalExtension());
            $cv = Media::create([
                'chemin' =>  $user_id . '.' . $request->file('cv')->getClientOriginalExtension(),
                'nom' =>  $user_id."_cv_".Str::random(20),
                "extension" => $request->file('cv')->getClientOriginalExtension(),
                'taille_en_ko' => FileHelper::convertByteToKo($request->file('cv')->getSize()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar_id' => $avatar->id ?? null,
            'cv_id' => $cv->id ?? null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
