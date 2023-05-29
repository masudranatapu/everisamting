<?php

namespace Modules\Designation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Designation\Entities\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $designations = Designation::paginate(10);
        return view('designation::index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('designation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:designations,name',
        ]);
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->slug = Str::slug($request->name);
        $designation->status = $request->status;
        $designation->save();
        flashSuccess('Designation Added Successfully');
        return redirect()->route('module.designation.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $designation = Designation::find($id);
        return view('designation::show', compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $designation = Designation::find($id);
        return view('designation::edit', compact('designation'));
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
            'name' => 'required|max:255|unique:designations,name,'.$id,
        ]);
        $designation = Designation::find($id);
        $designation->name = $request->name;
        $designation->status = $request->status;
        $designation->save();
        flashSuccess('Designation updated Successfully');
        return redirect()->route('module.designation.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        flashSuccess('Designation deleted Successfully');
        return back();
    }
}
