<?php

namespace App\Http\Controllers;

use App\Actions\Profile\ProfileUpdate;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Profile View.
     *
     * @return void
     */
    public function profile()
    {
        $user = auth('admin')->user();
        return view('backend.profile.index', compact('user'));
    }

    /**
     * Profile Setting.
     *
     * @return void
     */
    public function setting()
    {
        $user = auth('admin')->user();
        return view('backend.profile.setting', compact('user'));
    }


    /**
     * Profile Update.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function profile_update(ProfileRequest $request)
    {
        try {
            $profile = ProfileUpdate::update($request);

            if ($profile) {
                flashSuccess('Profile Updated Successfully');
                return back();
            } else {
                flashError('Current password does not match');
                return back();
            }
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }
}
