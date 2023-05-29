<?php

namespace Modules\ProductModel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\ProductModel\Entities\ProductModel;
use Modules\ServiceType\Entities\ServiceType;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $models = ProductModel::paginate(10);

        return view('productmodel::index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $brands = Brand::all();
        return view('productmodel::create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $model = new ProductModel();
        $model->name = $request->name;
        $model->brand_id = $request->brand_id;
        $model->slug = Str::slug($request->name);
        $model->status = $request->status;
        $model->save();
        flashSuccess('Product Model Added Successfully');
        return redirect()->route('module.model.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $model = ProductModel::find($id);
        return view('productmodel::show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = ProductModel::find($id);
        $brands = Brand::all();
        return view('productmodel::edit', compact('model', 'brands'));
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
            'name' => 'required|max:255',
        ]);
        $model = ProductModel::find($id);
        $model->name = $request->name;
        $model->brand_id = $request->brand_id;
        $model->status = $request->status;
        $model->save();
        flashSuccess('Product Model updated Successfully');
        return redirect()->route('module.model.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = ProductModel::find($id);;
        $model->delete();
        flashSuccess('Product Model deleted Successfully');
        return back();
    }
}
