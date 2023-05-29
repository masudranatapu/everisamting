<?php

namespace Modules\ServiceType\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\ServiceType\Entities\ServiceType;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $service_types = ServiceType::paginate(10);
        return view('servicetype::index', compact('service_types'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('servicetype::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|max:255|unique:service_types,name',
        ]);
        $service_type = new ServiceType();
        $service_type->name = $request->service_type;
        $service_type->slug = Str::slug($request->service_type);
        $service_type->status = $request->status;
        $service_type->save();
        flashSuccess('Service Type Added Successfully');
        return redirect()->route('module.serviceType.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $service_type = ServiceType::find($id);

        return view('servicetype::show', compact('service_type'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $service_type = ServiceType::find($id);
        return view('servicetype::edit', compact('service_type'));
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
            'service_type' => 'required|max:255|unique:service_types,name,'.$id,
        ]);
        $service_type = ServiceType::find($id);
        $service_type->name = $request->service_type;
        $service_type->status = $request->status;
        $service_type->save();
        flashSuccess('Service Type updated Successfully');
        return redirect()->route('module.serviceType.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $service_type = ServiceType::find($id);
        $service_type->delete();
        flashSuccess('Service Type deleted Successfully');
        return back();
    }
}
