<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdCreateTrait;
use App\Models\UserPlan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdGallery;
use Modules\Ad\Transformers\AdResourceMobile;
use Modules\Category\Entities\Category;

class AdController extends Controller
{
    use AdCreateTrait;

    public function categoryWiseAds(Category $category)
    {
        $paginate = request()->paginate ?? false;

        $category_wise_ads = $category->ads()->with('category');

        if ($paginate) {
            $ads = $category_wise_ads->simplePaginate($paginate);
        } else {
            $ads = $category_wise_ads->get();
        }

        return AdResourceMobile::collection($ads);
    }

    public function adDetails(Ad $ad)
    {


//        return response()->json($ad);

        $data['ad_details'] = $ad->load(['category', 'subcategory', 'model', 'designation', 'service_type', 'customer' => function ($q) {
            return $q->with(['userPlan']);
        }, 'brand', 'adFeatures', 'galleries']);


        $data['related_ads'] = Ad::with('category', 'subcategory', 'model', 'service_type', 'designation', 'customer', 'brand', 'adFeatures', 'galleries')->whereCategoryId($ad->category_id)->where('id', '!=', $ad->id)->latest()->limit(4)->get();

        return sendResponse(200, "Ad Details", $data, true, null);

        // return [
        //     'ad_details' => $ad_details,
        //     'related_ads' => $related_ads,
        // ];
    }

    public function adsCollection(Request $request)
    {
        Log::alert($request->all);
        $paginate = $request->paginate ?? 10;
        $filter_by = $request->filter_by ?? false;
        $sort_by = $request->sort_by ?? false;
        $query = Ad::with('category', 'subcategory', 'customer', 'brand', 'model', 'designation','service_type' , 'adFeatures', 'galleries')->orderBy('id', 'asc')->active();

        // Category filter
        if ($request->has('category') && $request->category != null) {
            $category = $request->category;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        // Subcategory filter
        if ($request->has('subcategory') && $request->subcategory != null) {
            $subcategory = $request->subcategory;

            $query->whereHas('subcategory', function ($q) use ($subcategory) {
                $q->where('slug', $subcategory);
            });
        }

        // Keyword search
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        // // City filter
        // if ($request->has('city') && $request->city != null) {
        //     $city = $request->city;

        //     $query->whereHas('city', function ($q) use ($city) {
        //         $q->whereIn('name', $city);
        //     });
        // }

        // // Town filter
        // if ($request->has('town') && $request->town != null) {
        //     $query->whereHas('town', function ($q) {
        //         $q->where('name', request('town'));
        //     });
        // }
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

        // Price filter
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



        // Filter by ads
        if ($filter_by && $filter_by == 'featured') {
            $query->where('featured', 1);
        } else if ($filter_by && $filter_by == 'popular') {
            $query->latest('total_views');
        }

        // Sort by ads
        if ($sort_by && $sort_by == 'latest') {
            $query->latest();
        } else if ($sort_by && $sort_by == 'oldest') {
            $query->oldest();
        }

        $discription = [
            'keyword' => "Optional peram,Anything, default value null",
            'paginate' => "Optional peram,Must be number, default value 10",
            'filter_by' => "Optional peram,Must be featured or popular , default null",
            'sort_by' => "Optional peram,Must be latest or oldest , default null",
            'category' => "Optional peram ,Must be category slug ,default null",
            'subcategory' => "Optional peram ,Must be subcategory slug ,default value null",
            'price_min' => "Optional peram ,Must be number, default value null",
            'price_max' => "Optional peram ,Must be number, default value null",
        ];

        $data=$query->paginate($paginate)->withQueryString();

        return sendResponse(200, "All Ad List",$data , true, $discription);
        // return [
        //     'discription' => $discription,
        //     'ads' => $query->paginate($paginate)->withQueryString(),
        //     'adMaxPrice' => DB::table('ads')->max('price'),
        // ];
    }

    public function storeAd(Request $request)
    {


        $category = Category::with('customFields.values')->FindOrFail($request->category_id);

        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required|max:1024',
            'email' => 'required_if:show_email,1',
            'phone' => 'required_if:show_phone,1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $discription = [
            "title" => "Title will be String",
            "category_id" => "Category must be id",
            "description" => "Description will be String 1024 Character Limit",
            "images" => "Image must be an image",
            'email.required_if' => 'Email field is required when email show to public is on',
            'phone.required_if' => 'Phone field is required when phone show to public is on',
        ];


        if ($validate->fails()) {
            return sendError(['discription' => $discription, 'errors' => $validate->errors()], "Validation Error");
        }


        DB::beginTransaction();
        try {


            $requestImage = explode(', ', trim($request->images, '[]'));


            $limit_exists = $this->adLimitChecking();
            $featured_exists = $this->featuredAdChecking();
            $maximum_ad_image_limit = setting('maximum_ad_image_limit');
            $base64 = $request->base64 ?? true;
            $image_count = $base64 ? count($requestImage) : count($request->file('images'));


            if (!$limit_exists) {
                $message = 'You have reached your ad limit. Please upgrade your plan to add more ads.';
                return sendError('Limit Error', $message,);
            }

            if ($request->featured && !$featured_exists) {
                $message = 'You have reached your featured ad limit. Please upgrade your plan to add more featured ads.';
                return sendError('Featured Limit Error', $message);
            }


//            if (($image_count < 1) || ($image_count > $maximum_ad_image_limit)) {
//                $message = 'Please upload at least 1 to ' . $maximum_ad_image_limit . 'images.';
//                return sendError('Image Limit Error', $message);
//            }

            $slug = Str::slug($request->title);
            $check = DB::table('ads')->where('slug', $slug)->first();
            $lastAD = Ad::orderBy('id', 'desc')->first();
            $slug_id = (int)$lastAD->id + 1;

            if ($check) {
                $slug = $slug . '-' . $slug_id;
            }
            if ($request->featured) {
                $isfeatured = 1;
                $is_featured = 'yes';
            } else {
                $isfeatured = 0;
                $is_featured = 'no';
            }

            $ad = new Ad();
            $ad->title = $request->title;
            $ad->slug = $slug;
            $ad->brand_id = $request->brand_id;
            $ad->show_phone = $request->show_phone ?? 0;
            $ad->show_email = $request->show_email ?? 0;
            $ad->phone = $request->phone;
            $ad->email = $request->email;
            $ad->price = $request->price;
            $ad->whatsapp = $request->whatsapp;
            $ad->featured = $isfeatured;
            $ad->is_featured = $is_featured;
            $ad->category_id = $request->category_id;
            $ad->subcategory_id = $request->subcategory_id;
            $ad->description = $request->description;
            $ad->user_id = Auth::user()->id;
            $ad->status = setting('ads_admin_approval') ? 'pending' : 'active';
            $ad->address = $request->address;

            //  services
            $ad->service_type_id = $request->service_type_id;

            // jobs
            $ad->experience = $request->experience;

            $ad->educations = $request->educations;
            $ad->designation_id = $request->designation_id;
            $ad->salary_from = $request->salary_from;
            $ad->salary_to = $request->salary_to;
            $ad->deadline = $request->deadline ? date_create($request->deadline) : null;
            $ad->employer_name = $request->employer_name;
            $ad->employment_type = $request->employment_type;
            $ad->employer_website = $request->employer_website;


            // mobiles
            $ad->condition = $request->condition;
            $ad->authenticity = $request->authenticity;
            $ad->ram = $request->ram;
            $ad->edition = $request->edition;
            $ad->product_model_id = $request->product_model_id;

            // Electronics & Pc
            $ad->processor = $request->processor;

            // vehicles
            $ad->trim_edition = $request->trim_edition;
            $ad->year_of_manufacture = $request->year_of_manufacture;
            $ad->engine_capacity = $request->engine_capacity;
            $ad->transmission = $request->transmission;
            $ad->registration_year = $request->registration_year;
            $ad->body_type = $request->body_type;
            $fuel_types = explode(',', trim($request->fuel_type, "[]"));
            $ad->fuel_type = $fuel_types;

            // property
            $ad->property_type = $request->property_type;
            $ad->size = $request->size;
            $ad->size_type = $request->size_type;
            $ad->property_location = $request->property_location;
            $ad->price_type = $request->price_type;
            $ad->bedroom = $request->bedroom;
            //pets
            $ad->animal_type = $request->animal_type;
            $ad->save();


            // image inserting
            $employer_logo = $request->employer_logo;
            if ($base64 && $employer_logo) {
                $employer_logo_url = uploadBase64FileToPublic($employer_logo, 'uploads/adds_multiple');
                $ad->employer_logo = $employer_logo_url;
                $ad->save();
            } else {
                if ($request->file('employer_logo')) {
                    $employer_logo = $request->file('employer_logo');
                    $employer_logo_url = $employer_logo->move('uploads/adds_multiple', $employer_logo->hashName());
                    $ad->employer_logo = $employer_logo_url;
                }
            }

            if ($base64 && $requestImage) {
                $images = $requestImage;
                foreach ($images as $key => $image) {

                    if ($key == 0 && $image) {
                        $url = uploadBase64FileToPublic($image, 'uploads/addds_images/');
                        $ad->update(['thumbnail' => $url]);
                    }

                    if ($image) {
                        $gallery_url = uploadBase64FileToPublic($image, 'uploads/adds_multiple/');
                        $ad->galleries()->create(['image' => $gallery_url]);
                    }
                }
            } else {
                $images = $request->file('images');


                if ($images) {
                    foreach ($images as $key => $image) {
                        if ($key == 0 && $image && $image->isValid()) {
                            $url = $image->move('uploads/addds_images', $image->hashName());
                            $ad->update(['thumbnail' => $url]);
                        }

                        if ($image && $image->isValid()) {
                            $gallery_url = $image->move('uploads/adds_multiple', $image->hashName());
                            $ad->galleries()->create(['image' => $gallery_url]);
                        }
                    }
                }
            }

            $requestedFeatures = $request->input("features[]");
            $trimArray = explode(',', trim($requestedFeatures, "[]"));

            // feature inserting
            if ($trimArray) {
                for ($i = 0; $i < count($trimArray); $i++) {

                    $ad->adFeatures()->create(['name' => $trimArray[$i]]);
                }
            }

            // if (env('APP_MODE') != "local") {

            //     $this->adNotification($ad, 'create', true);
            // }
            $this->userPlanInfoUpdate($ad->featured, auth()->guard('api')->id());
            DB::commit();

            return sendResponse(200, " Add Create Successfully", $ad, true, $discription);
        } catch (Exception $th) {
            DB::rollBack();
            return sendError('Exception Error', $th->getMessage());
        }
    }

    public function editAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to do this action'
            ], Response::HTTP_FORBIDDEN);
        }

        return $ad->load('category', 'subcategory', 'customer', 'brand', 'adFeatures', 'galleries');
    }

    public function updateAd(Request $request, Ad $ad)
    {

        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required|max:1024',
            'email' => 'required_if:show_email,1',
            'phone' => 'required_if:show_phone,1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $discription = [
            "title" => "Title will be String",
            "category_id" => "Category must be id",
            "description" => "Description will be String 1024 Charecter Limit",
            "images" => "Image must be an image",
            'email.required_if' => 'Email field is required when email show to public is on',
            'phone.required_if' => 'Phone field is required when phone show to public is on',
        ];

        if ($validate->fails()) {
            sendError(["discription" => $discription, "Errors" => $validate->errors()], 'Validation Error');
        }

        $category = Category::with('customFields.values')->FindOrFail($request->category_id);


        if ($ad->user_id != auth()->guard('api')->id()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'You are not allowed to do this action',
                    'code' => 200
                ],
                200
            );
        }
        $requestImage = explode(', ', trim($request->images, '[]'));
        $base64 = $request->base64 ?? true;


        if ($ad->is_featured == 'yes') {
            $isfeatured = 'yes';
            if ($request->featured) {
                $checkedfeatured = 1;
            } else {
                $checkedfeatured = 0;
            }
        } else {
            if ($request->featured) {
                $isfeatured = 'yes';

                $userplan = UserPlan::where('user_id', $ad->user_id)->first();
                UserPlan::where('id', $userplan->id)->update([
                    'featured_limit' => $userplan->featured_limit - 1,
                ]);

                $checkedfeatured = 1;
            } else {
                $isfeatured = 'no';
                $checkedfeatured = 0;
            }
        }
        $ad->title = $request->title;
        $ad->brand_id = $request->brand_id;
        $ad->show_phone = $request->show_phone ?? 0;
        $ad->show_email = $request->show_email ?? 0;
        $ad->phone = $request->phone;
        $ad->email = $request->email;
        $ad->price = $request->price;
        $ad->whatsapp = $request->whatsapp;
        $ad->featured = $checkedfeatured;
        $ad->is_featured = $isfeatured;
        $ad->category_id = $request->category_id;
        $ad->subcategory_id = $request->subcategory_id;
        $ad->description = $request->description;
        $ad->user_id = Auth::user()->id;
        $ad->address = $request->address;

        //  services
        $ad->service_type_id = $request->service_type_id;

        // jobs
        $ad->experience = $request->experience;
        $ad->educations = $request->educations;
        $ad->designation_id = $request->designation_id;
        $ad->salary_from = $request->salary_from;
        $ad->salary_to = $request->salary_to;
        $ad->deadline = $request->deadline ? date_create($request->deadline) : null;
        $ad->employer_name = $request->employer_name;
        $ad->employment_type = $request->employment_type;
        $ad->employer_website = $request->employer_website;


        // mobiles
        $ad->condition = $request->condition;
        $ad->authenticity = $request->authenticity;
        $ad->ram = $request->ram;
        $ad->edition = $request->edition;
        $ad->product_model_id = $request->product_model_id;

        // Electronics & Pc
        $ad->processor = $request->processor;

        // vehicles
        $ad->trim_edition = $request->trim_edition;
        $ad->year_of_manufacture = $request->year_of_manufacture;
        $ad->engine_capacity = $request->engine_capacity;
        $ad->transmission = $request->transmission;
        $ad->registration_year = $request->registration_year;
        $ad->body_type = $request->body_type;
        $fuel_types = explode(',', trim($request->fuel_type, "[]"));
        $ad->fuel_type = $fuel_types;

        // property
        $ad->property_type = $request->property_type;
        $ad->size = $request->size;
        $ad->size_type = $request->size_type;
        $ad->property_location = $request->property_location;
        $ad->price_type = $request->price_type;
        $ad->bedroom = $request->bedroom;
        //pets
        $ad->animal_type = $request->animal_type;

        $ad->save();


        // image updating
        $base64 = $request->base64 ?? true;

        // image inserting
        $employer_logo = $request->employer_logo;
        if ($base64 && $employer_logo) {
            $employer_logo_url = uploadBase64FileToPublic($employer_logo, 'uploads/adds_multiple');
            $ad->employer_logo = $employer_logo_url;
            $ad->save();
        } else {
            if ($request->file('employer_logo')) {
                $employer_logo = $request->file('employer_logo');
                $employer_logo_url = $employer_logo->move('uploads/adds_multiple', $employer_logo->hashName());
                $ad->employer_logo = $employer_logo_url;
                $ad->save();
            }
        }
        if ($base64 && $requestImage) {
            $images = $requestImage;
            foreach ($images as $key => $image) {

                if ($key == 0 && $image) {
                    $url = uploadBase64FileToPublic($image, 'uploads/addds_images/');
                    $ad->update(['thumbnail' => $url]);
                }

                if ($image) {
                    $gallery_url = uploadBase64FileToPublic($image, 'uploads/adds_multiple/');
                    $ad->galleries()->create(['image' => $gallery_url]);
                }
            }
        } else {
            $images = $request->file('images');


            if ($images) {
                foreach ($images as $key => $image) {
                    if ($key == 0 && $image && $image->isValid()) {
                        $url = $image->move('uploads/addds_images', $image->hashName());
                        $ad->update(['thumbnail' => $url]);
                    }

                    if ($image && $image->isValid()) {
                        $gallery_url = $image->move('uploads/adds_multiple', $image->hashName());
                        $ad->galleries()->create(['image' => $gallery_url]);
                    }
                }
            }
        }


        // feature inserting
        $ad->adFeatures()->delete();
        $requestedFeatures = $request->input("features[]");
        $trimArray = explode(',', trim($requestedFeatures, "[]"));

        // feature inserting
        if ($trimArray) {
            for ($i = 0; $i < count($trimArray); $i++) {

                $ad->adFeatures()->create(['name' => $trimArray[$i]]);
            }
        }

        if (env('APP_MODE') != "local") {

            $this->adNotification($ad, 'update', true);
        }


        return sendResponse(200, "Ad Update Successfully", $ad, true, $discription);
    }

    public function deleteAdGallery($ad_gallery)
    {
        $ad_gallery = AdGallery::find($ad_gallery);

        if ($ad_gallery) {
            $ad_gallery->delete();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Image not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ad gallery image deleted successfully',
        ], Response::HTTP_OK);
    }
}
