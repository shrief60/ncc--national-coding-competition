<?php

namespace App\Http\Controllers\User;

use App\Classes\CroppedImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\User;

class ProfileController extends Controller
{

    public function show(User $user = null)
    {

        if (is_null($user) && !auth()->check()) {
            return redirect('login');
        }

        $user = $user ?? auth()->user();

        return view('user.profile.show', compact('user'));
    }

    public function edit()
    {

        $user = auth()->user();

        if (!$user) {
            $user()->create();
        }

        return view('user.profile.edit', compact('user'));

    }

    public function update(ProfileUpdateRequest $request)
    {

        $user = auth()->user();

        if ($request->filled('name')) {
            $user->name = $request->name;
        } elseif ($request->filled('email')) {
            $user->email = $request->email;
        } elseif ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        } elseif ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->storeAs("avatars", "$user->username.jpg", 'public');
        } elseif ($request->has('gender')) {
            $user->gender = $request->gender;
        } elseif ($request->has('facebook_account')) {
            $user->facebook_account = $request->facebook_account;
        } elseif ($request->has('youtube_account')) {
            $user->youtube_account = $request->youtube_account;
        } elseif ($request->has('twitter_account')) {
            $user->twitter_account = $request->twitter_account;
        } elseif ($request->has('date_of_birth')) {
            $user->date_of_birth = $request->date_of_birth;
        } elseif ($request->has('city') || $request->has('city')) {
            $user->city = $request->city;
            $user->country = $request->country;
        } elseif ($request->has('phone_number')) {
            $user->phone_number = $request->phone_number;
        } elseif($request->has('bio')) {
            $user->bio = $request->bio;
        } elseif($request->has('school')) {
            $user->school = $request->school;
        }

        $user->save();

        if ($request->filled('country') || $request->filled('city')) {
            $request->merge(['location' => $user->location]);
        } else if ($request->has('date_of_birth')) {
            $request->merge(['birthday' => $user->birthday]);
        }

        if ($request->ajax()) {
            return api(['data' => $request->all()]);
        }

        return back();
    }
}
