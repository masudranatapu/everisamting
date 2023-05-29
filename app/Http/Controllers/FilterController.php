<?php

namespace App\Http\Controllers;

use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\SubCategory;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldValue;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;
use Modules\Designation\Entities\Designation;
use Modules\ProductModel\Entities\ProductModel;

class FilterController extends Controller
{
    /**
     * Search & filter post by keyword, category
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request, $category = null)
    {
        $query = Ad::activeCategory()->with(['category:id,name', 'productCustomFields' => function ($q) {
            $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                    ->where('listable', 1)
                    ->oldest('order')
                    ->without('customFieldGroup');
            }])->latest();
        }])->active();

//        $inputFields = [];
//        if (request()->filled('cf')) {
//            $inputFields = request()->get('cf');
//        }
//
//        foreach ($inputFields as $fieldId => $postValue) {
//            $field = CustomField::find($fieldId);
//            if (empty($field)) {
//                continue;
//            }
//
//            if (!is_array($postValue)) {
//                // Other fields
//                if (trim($postValue) == '') {
//                    continue;
//                }
//
//                $query->whereHas('productCustomFields', function ($query) use ($field, $postValue) {
//                    $query->where('custom_field_id', $field->id)->where('value', 'LIKE', "%$postValue%");
//                });
//            } else {
//                foreach ($postValue as $optionValue) {
//
//                    if (is_array($optionValue)) continue;
//                    if (!is_array($optionValue) && trim($optionValue) == '') continue;
//
//                    $query->whereHas('productCustomFields', function ($query) use ($field, $optionValue) {
//                        $query->where('custom_field_id', $field->id)->where('value', 'LIKE', "%$optionValue%");
//                    });
//                }
//            }
//        }

        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        if ($request->has('subcategory') && $request->subcategory != null) {
            $subcategory = $request->subcategory;

            $query->whereHas('subcategory', function ($q) use ($subcategory) {
                $q->whereIn('slug', $subcategory);
            });
        }
        if ($request->has('designation') && $request->designation != null) {
            $designation = $request->designation;

            $query->whereHas('designation', function ($q) use ($designation) {
                $q->whereIn('slug', $designation);
            });
        }
        if ($request->has('brand') && $request->brand != null) {
            $brand = $request->brand;

            $query->whereHas('brand', function ($q) use ($brand) {
                $q->whereIn('slug', $brand);
            });
        }
        if ($request->has('model') && $request->model != null) {
            $model = $request->model;

            $query->whereHas('model', function ($q) use ($model) {
                $q->whereIn('slug', $model);
            });
        }

//        jobs

        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }
        if ($request->has('condition') && $request->condition != null) {
            $query->whereIn('condition', $request->condition);
        }
        if ($request->has('bedroom') && $request->bedroom != null) {
            $query->whereIn('bedroom', $request->bedroom);
        }
        if ($request->has('education') && $request->education != null) {
            $query->whereIn('educations', $request->education);
        }
        if ($request->has('job_type') && $request->job_type != null) {
            $query->whereIn('employment_type', $request->job_type);
        }
//        property
        if ($request->has('fuel_type') && $request->fuel_type != null) {
            $query->whereIn('fuel_type', $request->fuel_type);
        }
        if ($request->has('transmission') && $request->transmission != null) {
            $query->whereIn('transmission', $request->transmission);
        }
        if ($request->has('body_type') && $request->body_type != null) {
            $query->whereIn('body_type', $request->body_type);
        }
        // Property
        if ($request->has('property_type') && $request->property_type != null) {
            $query->whereIn('property_type', $request->property_type);
        }
        // Size
        if ($request->has('sizes') && $request->sizes != null) {
            $query->whereIn('size', $request->sizes);
        }

        // location
        if ($request->has('lat') && $request->has('long') && $request->lat != null && $request->long != null) {
            $ids = $this->location_filter($request->lat, $request->long);

            $query->whereIn('id', $ids);
        }


        if ($request->has('price_min') && $request->price_min != null) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max != null) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->has('min_size') && $request->min_size != null) {
            $query->where('size', '>=', $request->min_size);
        }
        if ($request->has('max_size') && $request->max_size != null) {
            $query->where('price', '<=', $request->max_size);
        }
        if ($request->has('salary_from') && $request->salary_from != null) {
            $query->where('salary_from', '>=', $request->salary_from);
        }
        if ($request->has('salary_to') && $request->salary_to != null) {
            $query->where('salary_to', '<=', $request->salary_to);
        }
        if ($request->has('featured') && $request->featured == "all"){
            $query->where('featured',true)->where('is_featured','yes');
        }

    $data['adlistings'] =  $query->paginate(request('per_page', 15))->onEachSide(1)->withQueryString();

        // return $data;
        $data['categories'] = Category::active()->where('type', 1)->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->latest('id')->get();
        $data['adMaxPrice'] = $price = DB::table('ads')->max('price');
        if ($category) {
            $category_id = Category::where('slug', $category)->first()->id;
            $data['brands'] = Brand::where('category_id', $category_id)->get();
            if ($request->brand && $request->brand != '') {
                $brands_id = Brand::whereIn('slug', $request->brand)->pluck('id')->toArray();
                $data['models'] = ProductModel::wherein('brand_id', $brands_id)->get();
            }
        }
        $data['designations'] = Designation::where('status', 1)->get();
        // return $data;

        $data['isMob'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));

        // Check if the "tablet" word exists in User-Agent
        $data['isTab'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));

        $data['isWin'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
        $data['isMac'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "Mac"));


        return view('frontend.ad-list', $data);
    }

    public function location_filter($latitude, $longitude)
    {
        // $latitude = -58.7699;
        // $longitude = 40.283499;
        $distance = 50;

        $haversine = "(
                    6371 * acos(
                        cos(radians(" . $latitude . "))
                        * cos(radians(`lat`))
                        * cos(radians(`long`) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
                    )
                )";

        $data = Ad::select('id')->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $distance)->get();

        $ids = [];

        foreach ($data as $id) {
            array_push($ids, $id->id);
        }

        return $ids;
    }
}
