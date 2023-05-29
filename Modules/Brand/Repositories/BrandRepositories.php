<?php

namespace Modules\Brand\Repositories;

use Modules\Brand\Actions\CreateBrand;
use Modules\Brand\Actions\DeleteBrand;
use Modules\Brand\Actions\UpdateBrand;
use Modules\Brand\Entities\Brand;

class BrandRepositories implements BrandInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Brand::withCount('ads')->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Object $data
     */
    public function store(Object $data)
    {
        return CreateBrand::create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Object $request
     * @param Object $product
     * @return \Illuminate\Http\Response
     */
    public function update(Object $request, Object $data)
    {
        return UpdateBrand::update($request, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Object $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Object $data)
    {
        return DeleteBrand::delete($data);
    }
}
