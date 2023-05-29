<?php

namespace Modules\Map\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SetupGuide\Entities\SetupGuide;
use Illuminate\Contracts\Support\Renderable;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('map::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('map::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('map::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('map::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $setting = Setting::first();

        if ($request->from_preference) {

            $request->validate([
                'map_type' => 'required'
            ]);

            if ($request->map_type == 'google-map') {
                $request->validate([
                    'google_map_key' => 'required',
                ]);
            } else {
                $request->validate([
                    'map_box_key' => 'required',
                ]);
            }

            if ($request->map_type == 'google-map') {
                $setting->update([
                    'default_map' => $request->map_type,
                    'google_map_key' => $request->google_map_key,
                ]);
            } else {
                $setting->update([
                    'default_map' => $request->map_type,
                    'map_box_key' => $request->map_box_key,
                ]);
            }
        } else {
            $request->validate([
                'map_type' => 'required',
                'default_long' => 'required',
                'default_lat' => 'required',
            ]);

            if ($request->map_type == 'google-map') {
                $request->validate([
                    'google_map_key' => 'required',
                ]);
            } else {
                $request->validate([
                    'map_box_key' => 'required',
                ]);
            }

            $setting->update([
                'default_map' => $request->map_type,
                'default_long' => $request->default_long,
                'default_lat' => $request->default_lat,
            ]);
            if ($request->map_type == 'google-map') {
                $setting->update([
                    'google_map_key' => $request->google_map_key,
                ]);
            } else {
                $setting->update([
                    'map_box_key' => $request->map_box_key,
                ]);
            }
        }

        SetupGuide::where('task_name', 'map_setting')->update(['status' => 1]);
        flashSuccess('Map data updated !');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
