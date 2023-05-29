<?php

namespace Modules\Brand\Http\Controllers;

use Modules\Brand\Entities\Brand;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Brand\Http\Requests\BrandFormRequest;
use Modules\Brand\Repositories\BrandRepositories;
use Modules\Category\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BrandController extends Controller
{
    use ValidatesRequests;

    protected $brand;
    public function __construct(BrandRepositories $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the brands.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('brand.view')) {
            return abort(403);
        }
        $brands = $this->brand->all();
        return view('brand::index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('brand.create')) {
            return abort(403);
        }

        $categories = Category::where('status', 1)->get();
        return view('brand::create', compact('categories'));

    }

    /**
     * Store a newly created brand in storage.
     *
     * @param BrandFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandFormRequest $request)
    {
        if (!userCan('brand.create')) {
            return abort(403);
        }
        try {
            $this->brand->store($request);

            flashSuccess('Brand Added Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified brand.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        if (!userCan('brand.update')) {
            return abort(403);
        }
        $categories = Category::where('status', 1)->get();
        return view('brand::edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified brand in storage.
     *
     * @param BrandFormRequest $request
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandFormRequest $request, Brand $brand)
    {
        if (!userCan('brand.update')) {
            return abort(403);
        }
        try {
            $this->brand->update($request, $brand);

            flashSuccess('Brand Updated Successfully');
            return redirect(route('module.brand.index'));
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified brand from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if (!userCan('brand.delete')) {
            return abort(403);
        }

        try {
            $this->brand->destroy($brand);

            flashSuccess('Brand Deleted Successfully');
            return redirect(route('module.brand.index'));
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    public function show(Brand $brand){
        $brand->loadCount('ads');
        $ads = $brand->ads;

        return view('brand::show', compact('brand','ads'));
    }
}
