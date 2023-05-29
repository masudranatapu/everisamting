<?php

namespace Modules\MobileApp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MobileApp\Entities\MobileAppConfig;

class MobileAppController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $config = MobileAppConfig::first();
        return view('mobileapp::index', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate([
            'android_download_url' => 'nullable|url|max:250',
            'ios_download_url' => 'nullable|url|max:250',
            'privacy_url' => 'nullable|url|max:250',
            'support_url' => 'nullable|url|max:250',
            'terms_and_condition_url' => 'nullable|url|max:250',
        ]);

        $config = MobileAppConfig::first();
        $config->update($request->all());

        flashSuccess('Mobile App Config Updated Successfully');
        return redirect()->route('mobile-config.index');
    }
}
