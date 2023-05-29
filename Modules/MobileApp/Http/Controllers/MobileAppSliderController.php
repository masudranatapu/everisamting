<?php

namespace Modules\MobileApp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MobileApp\Actions\SortingSlider;
use Modules\MobileApp\Entities\MobileAppSlider;

class MobileAppSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $sliders = MobileAppSlider::orderBy('order')->get();

        return view('mobileapp::slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('mobileapp::slider.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'background' => "required|image|max:3072|mimes:jpeg,png,jpg",
        ]);

        MobileAppSlider::create($request->all());

        flashSuccess('Slider created successfully.');
        return redirect()->route('mobile-slider.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $slider = MobileAppSlider::find($id);
        return view('mobileapp::slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'background' => "required|image|max:3072|mimes:jpeg,png,jpg",
        ]);

        $slider = MobileAppSlider::find($id);
        $slider->update(['name' => $request->name]);

        $background = $request->background;
        if ($background) {
            $url = uploadImage($background, 'slider');
            $slider->update(['background' => $url]);
        }

        flashSuccess('Slider created successfully.');

        return redirect()->route('mobile-slider.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        MobileAppSlider::find($id)->delete();

        flashSuccess('Slider deleted successfully.');

        return redirect()->route('mobile-slider.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        try {
            SortingSlider::sort($request);
            return response()->json(['message' => 'Slider Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    public function status_change(Request $request)
    {
        $product = MobileAppSlider::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['message' => 'Slider Activated Successfully']);
        } else {
            return response()->json(['message' => 'Slider Inactivated Successfully']);
        }
    }
}
