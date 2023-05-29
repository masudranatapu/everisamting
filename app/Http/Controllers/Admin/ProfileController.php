<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Actions\Profile\ProfileUpdate;
use App\Traits\UploadAble;

use function Symfony\Component\String\b;

class ProfileController extends Controller
{
    use UploadAble;
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
        if (is_null($this->user) || !$this->user->can('profile.view')) {
            abort(403, 'Sorry !! You are Unauthorized to profile.');
        }
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Profile Setting.
     *
     * @return void
     */
    public function setting()
    {
        if (is_null($this->user) || !$this->user->can('profile.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to profile settings.');
        }
        $user = auth()->user();
        return view('admin.profile.setting', compact('user'));
    }


    /**
     * Profile Update.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function profile_update(ProfileRequest $request)
    {
        if (is_null($this->user) || !$this->user->can('profile.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to profile settings.');
        }

        $data = $request->only(['name','email']);
        $user = auth('admin')->user();
        if($request->hasFile('image')){

            // $data['image'] = $this->uploadOne($request->image, 'user');
            
            $brand_image = $request->file('image');
            $slug = 'brand';
            $brand_image_name = $slug.'-'.uniqid().'.'.$brand_image->getClientOriginalExtension();
            $upload_path = 'media/brand/';
            $brand_image->move($upload_path, $brand_image_name);

            $data['image'] = $upload_path.$brand_image_name;

            $this->deleteOne($user->image);

        }

        if($request->isPasswordChange == 1){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profile update successfully!');
    }
}
