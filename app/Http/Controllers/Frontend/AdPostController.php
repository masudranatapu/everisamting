<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdCreateTrait;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdGallery;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\ProductCustomField;
use Modules\Designation\Entities\Designation;
use Modules\ProductModel\Entities\ProductModel;
use Modules\ServiceType\Entities\ServiceType;

class AdPostController extends Controller
{
    use AdCreateTrait;

    /**
     * Ad Create step 1.
     * @return void
     */
    public function postStep1()
    {
        $this->stepCheck();
//        if (session('step1')) {

        // $html = __('directories');

        // dd($html);
        $categories = Category::where('type', 1)->where('status', 1)->latest('id')->get();
        $brands = Brand::latest('id')->get();
        $ad = session('ad');

//            return view('frontend.postad.step1', compact('categories', 'brands', 'ad'));
        return view('frontend.postad.category', compact('categories', 'brands', 'ad'));
//        } else {
//            return redirect()->route('frontend.post');
//        }
    }

    public function create($category = null)
    {
        $cat = Category::where('slug', $category)->first();
        if (!isset($cat)) {
            return redirect()->route('frontend.post');
        }
        $brands = Brand::where('category_id', $cat->id)->get();
        $designations = Designation::where('status', 1)->get();
        $service_types = ServiceType::where('status', 1)->get();
//        $models = ProductModel::where('status', 1)->get();
        $user_plan = UserPlan::where('user_id', Auth::user()->id)->first();
        return view('frontend.postad.create', compact('cat', 'brands', 'designations', 'service_types', 'user_plan'));
    }

    /**
     * Ad Create step 2.
     *
     * @return void
     */
    public function postStep2()
    {
//        dd('ff');
        if (session('step2')) {
            $ad = session('ad');
            // dd($ad);

            $category = Category::with('customFields.values')->FindOrFail($ad->category_id);

            return view('frontend.postad.step2', compact('ad', 'category'));
        } else {
            return redirect()->route('frontend.post');
        }
    }

    /**
     * Ad Create step 3.
     *
     * @return void
     */
    public function postStep3()
    {
        if (session('step3')) {
            return view('frontend.postad.step3');
        } else {
            return redirect()->route('frontend.post');
        }
    }


    public function getBrand($id)
    {
        $brand = Brand::where('category_id', $id)->get();

        return response()->json($brand);
    }


    /**
     * Store Ad Create step 1.ul Islam <devboyarif@gmail.com>
     * @param Request $request
     * @return void
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1024',
            'email' => 'required_if:show_email,1',
            'phone' => 'required_if:show_phone,1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.required_if' => 'Email field is required when email show to public is on',
            'phone.required_if' => 'Phone field is required when phone show to public is on',
        ]);

        if ($request->featured) {
            $isfeatured = 1;
            $is_featured = 'yes';
        } else {
            $isfeatured = 0;
            $is_featured = 'no';
        }


        $slug = Str::slug($request->title);
        $check = DB::table('ads')->where('slug', $slug)->first();

        if ($check) {
            $lastAD = Ad::orderBy('id', 'desc')->first();
            $slug_id = (int)$lastAD->id + 1;
            $slug = $slug . '-' . $slug_id;
        }

        try {
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

            $employer_logo = $request->file('employer_logo');
            if ($employer_logo) {
                $employer_logo_url = uploadAdImage($employer_logo, 'adds_multiple', 250, 200, true);
                $ad->employer_logo = $employer_logo_url;
            }

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
            $ad->fuel_type = $request->fuel_type;

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
//            dd($ad);


            // image uploading
            $images = $request->file('images');
            if (isset($images)) {
                foreach ($images as $key => $image) {
                    if ($key == 0 && $image && $image->isValid()) {

                        $url = uploadAdImage($image, 'addss_image', 850, 650, true);
                        $ad->update(['thumbnail' => $url]);
                    }

                    if ($key > 0 && $image && $image->isValid()) {

                        $url = uploadAdImage($image, 'adds_multiple', 850, 650, true);
                        $ad->galleries()->create(['image' => $url]);
                    }
                }
            }

            // feature inserting
            $features = $request->features;
            if (isset($features)) {
                foreach ($features as $feature) {
                    if (isset($feature) && $feature != null) {
                        $ad->adFeatures()->create(['name' => $feature]);
                    }
                }
            }

            $this->userPlanInfoUpdate($ad->featured, Auth::user()->id);
            return view('frontend.postad.postsuccess', [
                'ad_slug' => $ad->slug,
                'mode' => 'create'
            ]);

        } catch (\Throwable $th) {
//            dd($th);
            $this->forgetStepSession();
            return redirect()->back()->with('error', 'Something went wrong while saving your ad.Please try again.');
        }


    }

    public function storePostStep1(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required_unless:category_id,2,10',
            'category_id' => 'required',
        ]);

        if ($request->featured) {
            $isfeatured = 1;
            $is_featured = 'yes';
        } else {
            $isfeatured = 0;
            $is_featured = 'no';
        }

        if ($request->show_phone) {
            $showphone = 1;
        } else {
            $showphone = 0;
        }
        $slug = Str::slug($request->title);
        $check = DB::table('ads')->where('slug', $slug)->first();
        $lastAD = Ad::orderBy('id', 'desc')->first();
        $slug_id = (int)$lastAD->id + 1;

        if ($check) {
            $slug = $slug . '-' . $slug_id;
        }

        try {
            if (empty(session('ad'))) {
                $ad = new Ad();
                $ad['title'] = $request->title;
                $ad['slug'] = $slug;
                $ad['brand_id'] = $request->brand_id;
                $ad['phone'] = $request->phone;
                $ad['featured'] = $isfeatured;
                $ad['is_featured'] = $is_featured;
                $ad['show_phone'] = $showphone;
                $ad['subcategory_id'] = $request->subcategory_id;
                $ad->fill($validatedData);
                $request->session()->put('ad', $ad);
            } else {
                $ad = session('ad');
                $ad['title'] = $request->title;
                $ad['slug'] = $slug;
                $ad['featured'] = $isfeatured;
                $ad['is_featured'] = $is_featured;
                $ad['show_phone'] = $showphone;
                $ad['brand_id'] = $request->brand_id;
                $ad['phone'] = $request->phone;
                $ad['subcategory_id'] = $request->subcategory_id;
                $ad->fill($validatedData);
                $request->session()->put('ad', $ad);
            }

            $this->step1Success();
            $this->userPlanInfoUpdate($ad->featured, Auth::user()->id);
            return redirect()->route('frontend.post.step2');

        } catch (\Throwable $th) {
            $this->forgetStepSession();
            return redirect()->back()->with('error', 'Something went wrong while saving your ad.Please try again.');
        }
    }

    /**
     * Store Ad Create step 2.
     * @param Request $request
     * @return void
     */
    public function storePostStep2(Request $request)
    {


        $validatedData = $request->validate([
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'location' => 'required'
        ]);


        // $region = array_key_exists("region", $location) ? $location['region'] : '';
        // $country = array_key_exists("country", $location) ? $location['country'] : '';
        $address = $request->location ?? '';

        $maximum_ad_image_limit = setting('maximum_ad_image_limit');

        if (!$request->hasFile('images')) {
            return redirect()->back()->with('error', 'Please upload at least 1 image.');
        }

        // $image_count = count($request->file('images'));
        // if (($image_count < 2) || ($image_count > $maximum_ad_image_limit)) {
        //     return redirect()->back()->with('error', 'Please upload at least 1 to ' . $maximum_ad_image_limit . ' images.');
        // }

        $ad = session('ad');
        $ad['description'] = $validatedData['description'];
        $ad['lat'] = 0;
        $ad['long'] = 0;
        $ad['user_id'] = Auth::user()->id;
        $request->session()->put('ad', $ad);
        $ad['status'] = setting('ads_admin_approval') ? 'pending' : 'active';
        $ad['address'] = $request->location ?? "";
        $ad->save();

        // image uploading
        $images = $request->file('images');
        foreach ($images as $key => $image) {
            if ($key == 0 && $image && $image->isValid()) {

                $url = uploadAdImage($image, 'addss_image', 850, 650, true);
                $ad->update(['thumbnail' => $url]);
            }

            if ($image && $image->isValid()) {

                $url = uploadAdImage($image, 'adds_multiple', 850, 650, true);
                $ad->galleries()->create(['image' => $url]);
            }
        }

        // feature inserting
        $features = $request->features;
        if (isset($features)) {
            foreach ($features as $feature) {
                if (isset($feature) && $feature != null) {
                    $ad->adFeatures()->create(['name' => $feature]);
                }
            }
        }

        // // <!--  location  -->
        // $location = session()->get('location');

        // $region = array_key_exists("region", $location) ? $location['region'] : '';
        // $country = array_key_exists("country", $location) ? $location['country'] : '';
        // $address = Str::slug($region . '-' . $country);

        // ===================== For Custom Field   ================

        $category = Category::with('customFields.values')->FindOrFail($ad->category_id);

        foreach ($category->customFields as $field) {

            if ($field->slug !== $request->has($field->slug) && $field->required) {
                if ($field->type != 'checkbox' && $field->type != 'checkbox_multiple') {
                    $request->validate([
                        $field->slug => 'required',
                    ]);
                }
            }
            if ($field->type == 'textarea') {
                $request->validate([
                    $field->slug => 'max:255',
                ]);
            }
            if ($field->type == 'url') {
                $request->validate([
                    $field->slug => 'url',
                ]);
            }
            if ($field->type == 'number') {
                $request->validate([
                    $field->slug => 'numeric',
                ]);
            }
            if ($field->type == 'date') {
                $request->validate([
                    $field->slug => 'date',
                ]);
            }
            $ff[] = $field;
        }

        $newItem = [];
        if (isset($ff)) {
            foreach ($ff as $key => $value) {

                $fileType = $value->type;

                if ($fileType == 'file') {

                    $image = uploadImage($value, '/custom-field/');

                    $item = [$key => $image];
                } else {

                    $item = [$key => $value];
                }

                array_push($newItem, $item);
            }
        }


        session()->put('custom-field', $newItem);
        session()->put('custom-field-checkbox', $request->get('cf'));

        $customField = session()->get('custom-field'); // without checkbox
        $checkboxFields = session()->get('custom-field-checkbox'); // with checkbox
        // dd($customField);

        // dd($customField);
        if ($checkboxFields) {
            foreach ($checkboxFields as $key => $values) {
                $CustomField = CustomField::findOrFail($key)->load('customFieldGroup');

                if (gettype($values) == 'array') {
                    $imploded_value = implode(", ", $values);

                    $ad->productCustomFields()->create([
                        'custom_field_id' => $key,
                        'value' => $imploded_value,
                        'custom_field_group_id' => $CustomField->custom_field_group_id,
                    ]);
                } else {
                    $ad->productCustomFields()->create([
                        'custom_field_id' => $key,
                        'value' => $values ?? '0',
                        'custom_field_group_id' => $CustomField->custom_field_group_id,
                    ]);
                }
            }
        }

        $category = Category::with('customFields.values')->FindOrFail($ad->category_id);

        $customField = session()->get('custom-field');
        $keys = array_keys($customField);


        for ($i = 0; $i < count($customField); $i++) {

            foreach ($customField[$keys[$i]] as $key => $value) {
                $CustomField = CustomField::findOrFail($value->id)->load('customFieldGroup');
                $ad->productCustomFields()->create([
                    'custom_field_id' => $value->id,
                    'value' => request($value->slug),
                    'custom_field_group_id' => $CustomField->custom_field_group_id,
                ]);
            }
        }

        session()->forget('custom-field');

        // $ad->update([
        //     'address' => $address,
        //     'neighborhood' => array_key_exists("neighborhood", $location) ? $location['neighborhood'] : '',
        //     'locality' => array_key_exists("locality", $location) ? $location['locality'] : '',
        //     'place' => array_key_exists("place", $location) ? $location['place'] : '',
        //     'district' => array_key_exists("district", $location) ? $location['district'] : '',
        //     'postcode' => array_key_exists("postcode", $location) ? $location['postcode'] : '',
        //     'region' => array_key_exists("region", $location) ? $location['region'] : '',
        //     'country' => array_key_exists("country", $location) ? $location['country'] : '',
        //     'long' => array_key_exists("lng", $location) ? $location['lng'] : '',
        //     'lat' => array_key_exists("lat", $location) ? $location['lat'] : '',
        // ]);

        // session()->forget('location');
        session()->forget('ad');
        session()->forget('ad_details');

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'create'
        ]);
    }

    /**
     * Store Ad Create step 3.
     * @param Request $request
     * @return void
     */

    public function storePostStep3(Request $request)
    {
        // $maximum_ad_image_limit = setting('maximum_ad_image_limit');

        // $validatedData = $request->validate([
        //     'description' => 'required',
        //     'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        // ]);

        // if (!$request->hasFile('images')) {
        //     return redirect()->back()->with('error', 'Please upload at least 2 to ' . $maximum_ad_image_limit . ' images.');
        // }

        // $image_count = count($request->file('images'));
        // if (($image_count < 2) || ($image_count > $maximum_ad_image_limit)) {
        //     return redirect()->back()->with('error', 'Please upload at least 2 to ' . $maximum_ad_image_limit . ' images.');
        // }

        // $ad = session('ad');
        // $ad['description'] = $validatedData['description'];
        // $ad['user_id'] = auth('user')->id();
        // $ad['whatsapp'] = $ad['whatsapp'] ?? '';
        // $request->session()->put('ad', $ad);
        // $ad['status'] = setting('ads_admin_approval') ? 'pending' : 'active';
        // $ad->save();

        // // image uploading
        // $images = $request->file('images');
        // foreach ($images as $key => $image) {
        //     if ($key == 0 && $image && $image->isValid()) {

        //         $url = uploadImage($image, 'addss_image', true);
        //         $ad->update(['thumbnail' => $url]);
        //     }

        //     if ($image && $image->isValid()) {

        //         $url = uploadImage($image, 'adds_multiple', true);
        //         $ad->galleries()->create(['image' => $url]);
        //     }
        // }

        // // feature inserting
        // $features = $request->features;
        // foreach ($features as $feature) {
        //     $ad->adFeatures()->create(['name' => $feature]);
        // }

        // $this->forgetStepSession();
        // $this->adNotification($ad);
        // !setting('ads_admin_approval') ? $this->userPlanInfoUpdate($ad->featured) : '';

        // // ===================== For Custom Field   ================
        // $customField  =  session()->get('custom-field'); // without checkbox
        // $checkboxFields = session()->get('custom-field-checkbox'); // with checkbox

        // if ($checkboxFields) {
        //     foreach ($checkboxFields as $key => $values) {
        //         $CustomField = CustomField::findOrFail($key)->load('customFieldGroup');

        //         if (gettype($values) == 'array') {
        //             $imploded_value = implode(", ", $values);

        //             $ad->productCustomFields()->create([
        //                 'custom_field_id' => $key,
        //                 'value' => $imploded_value,
        //                 'custom_field_group_id' => $CustomField->custom_field_group_id,
        //             ]);
        //         } else {
        //             $ad->productCustomFields()->create([
        //                 'custom_field_id' => $key,
        //                 'value' => $values ?? '0',
        //                 'custom_field_group_id' => $CustomField->custom_field_group_id,
        //             ]);
        //         }
        //     }$field->slug
        // }

        // $category = Category::with('customFields.values')->FindOrFail($ad->category_id);
        // foreach ($category->customFields as $field) {

        //     $customField  =  session()->get('custom-field');
        //     $keys = array_keys($customField);

        //     for ($i = 0; $i < count($customField); $i++) {

        //         foreach ($customField[$keys[$i]] as $key => $value) {

        //             if ($field->slug == $key) {
        //                 $CustomField = CustomField::findOrFail($field->id)->load('customFieldGroup');

        //                 $ad->productCustomFields()->create([
        //                     'custom_field_id' => $field->id,
        //                     'value' => $value,
        //                     'custom_field_group_id' => $CustomField->custom_field_group_id,
        //                 ]);
        //             }
        //         }
        //     }
        // }
        // session()->forget('custom-field');

        // // <!--  location  -->
        // $location = session()->get('location');

        // $region = array_key_exists("region", $location) ? $location['region'] : '';
        // $country = array_key_exists("country", $location) ? $location['country'] : '';
        // $address = Str::slug($region . '-' . $country);

        // $ad->update([
        //     'address' => $address,
        //     'neighborhood' => array_key_exists("neighborhood", $location) ? $location['neighborhood'] : '',
        //     'locality' => array_key_exists("locality", $location) ? $location['locality'] : '',
        //     'place' => array_key_exists("place", $location) ? $location['place'] : '',
        //     'district' => array_key_exists("district", $location) ? $location['district'] : '',
        //     'postcode' => array_key_exists("postcode", $location) ? $location['postcode'] : '',
        //     'region' => array_key_exists("region", $location) ? $location['region'] : '',
        //     'country' => array_key_exists("country", $location) ? $location['country'] : '',
        //     'long' => array_key_exists("lng", $location) ? $location['lng'] : '',
        //     'lat' => array_key_exists("lat", $location) ? $location['lat'] : '',
        // ]);

        // session()->forget('location');

        // return view('frontend.postad.postsuccess', [
        //     'ad_slug' => $ad->slug,
        //     'mode' => 'create'
        // ]);
    }

    /**
     * Ad Edit step 1.
     * @return void
     */
    public function edit(Ad $ad)
    {
        $brands = Brand::where('category_id', $ad->category_id)->get();
        $designations = Designation::where('status', 1)->get();
        $service_types = ServiceType::where('status', 1)->get();
        $models = ProductModel::where('brand_id', $ad->brand_id)->where('status', 1)->get();
        $user_plan = UserPlan::where('user_id', Auth::user()->id)->first();

        return view('frontend.postad_edit.edit', compact('ad', 'brands', 'designations', 'service_types', 'models', 'user_plan'));

    }

    public function update(Request $request, Ad $ad)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1024',
            'email' => 'required_if:show_email,1',
            'phone' => 'required_if:show_phone,1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.required_if' => 'Email field is required  when email show to public is on',
            'phone.required_if' => 'Phone field is required when phone show to public is on',
        ]);

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

        $employer_logo = $request->file('employer_logo');
        if ($employer_logo) {
            $employer_logo_url = uploadAdImage($employer_logo, 'adds_multiple', 250, 200, true);
            $ad->employer_logo = $employer_logo_url;
        }

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
        $ad->fuel_type = $request->fuel_type;

        // property
        $ad->property_type = $request->property_type;
        $ad->size = $request->size;
        $ad->size_type = $request->size_type;
        $ad->property_location = $request->property_location;
        $ad->price_type = $request->price_type;
        $ad->bedroom = $request->bedroom;

        if ($request->file('thumbnail')) {
            if (File::exists($ad->thumbnail)) {
                File::delete($ad->thumbnail);
            }
            $thumbnail = uploadAdImage($request->thumbnail, 'addss_image', 850, 650, true);
            $ad->thumbnail = $thumbnail;
        }
        //pets
        $ad->animal_type = $request->animal_type;

        $ad->save();


        $features = $request->features;
        $ad->adFeatures()->delete();
        if ($features && count($features) > 0) {
            if (isset($feature)) {
                foreach ($features as $feature) {
                    $ad->adFeatures()->create(['name' => $feature]);
                }
            }
        }


        $images = $request->file('images');
        $old = $request->old;
        $gallery = AdGallery::where('ad_id', $ad->id)->get();
        if ($old) {
            foreach ($gallery as $value) {
                if (!in_array($value->id, $old)) {
                    if (File::exists($value->image)) {
                        File::delete($value->image);
                    }
                    $value->delete();
                }
            };
        } else {
            foreach ($gallery as $value) {
                if (File::exists($value->image)) {
                    File::delete($value->image);
                }
                $value->delete();
            };
        }
        if ($images) {
            foreach ($images as $key => $image) {

                if ($image && $image->isValid()) {

                    $url = uploadAdImage($image, 'adds_multiple', 850, 650, true);
                    $ad->galleries()->create(['ad_id' => $ad->id, 'image' => $url]);
                }
            }
        }

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'update',
        ]);
    }


    public function editPostStep1(Ad $ad)
    {
        $fields = $ad->productCustomFields;
        if (auth('user')->id() == $ad->user_id) {
            $this->stepCheck();
            session(['edit_mode' => true]);

            if (session('step1') && session('edit_mode')) {
                $ad = collectionToResource($this->setAdEditStep1Data($ad));
                $categories = Category::where('type', 1)->latest('id')->get();
                $brands = Brand::latest('id')->get();
                return view('frontend.postad_edit.step1', compact('ad', 'categories', 'brands', 'fields'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Ad Edit step 2.
     *
     * @return void
     */
    public function editPostStep2(Ad $ad)
    {
        $fields = $ad->productCustomFields->groupBy('custom_field_group_id');
        // dd($fields);

        $lat = $ad->lat;
        $long = $ad->long;

        if (auth('user')->id() == $ad->user_id) {

            $ad = collectionToResource($this->setAdEditStep2Data($ad));

            if (session('step2') && session('edit_mode')) {

                return view('frontend.postad_edit.step2', compact('lat', 'long', 'ad', 'fields'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Edit Ad step 3.
     *
     * @return void
     */
    public function editPostStep3(Ad $ad)
    {
        $ad->load('adFeatures', 'galleries');

        if (auth('user')->id() == $ad->user_id) {
            $ad = collectionToResource($this->setAdEditStep3Data($ad));

            if (session('step3') && session('edit_mode')) {
                return view('frontend.postad_edit.step3', compact('ad'));
            } else {
                return redirect()->route('frontend.dashboard');
            }
        }

        abort(404);
    }

    /**
     * Update Ad step 1.ul Islam <devboyarif@gmail.com>
     * @param Request $request
     * @return void
     */
    public function UpdatePostStep1(Request $request, Ad $ad)
    {
        // dd($ad->is_featured);
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

        $request->validate([
            'title' => "required",
            'price' => 'required_unless:category_id,2,10',
            'category_id' => 'required',
            // 'brand_name' => 'required',
        ]);

        $ad->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'price' => $request->price,
            'featured' => $checkedfeatured,
            'is_featured' => $isfeatured,
        ]);

        if ($request->cancel_edit) {
            $this->forgetStepSession();
            return redirect()->route('frontend.dashboard');
        } else {
            $this->step1Success();
            return redirect()->route('frontend.post.edit.step2', $ad->slug);
        }
    }

    /**
     * Update Ad step 2.
     * @param Request $request
     * @return void
     */
    public function updatePostStep2(Request $request, Ad $ad)
    {

        $validatedData = $request->validate([
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'location' => 'required'
        ]);

        // $location = session()->get('location');

        $ad->update([
            'description' => $request->description,
            'address' => $request->location
        ]);

        // feature inserting
        $ad->adFeatures()->delete();
        foreach ($request->features as $feature) {
            if ($feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }
        $this->updateCustomField($request, $ad);

        // image uploading
        $thumbnail = $request->file('thumbnail');
        $old_thumb = $request->old_thumbnail;
        if ($thumbnail && $thumbnail->isValid()) {
            $path = 'uploads/addds_images/';
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $url = uploadAdImage($thumbnail, 'addss_image', 850, 650, true);
            $ad->update(['thumbnail' => $url]);
            if ($old_thumb) {
                @unlink($old_thumb);
            }
        }

        $images = $request->file('images');
        // dd($images);
        if ($images) {
            foreach ($images as $image) {
                if ($image && $image->isValid()) {

                    $path = 'uploads/adds_multiple/';
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                    }

                    $url = uploadAdImage($image, 'adds_multiple', 850, 650, true);
                    $ad->galleries()->create(['image' => $url]);
                }
            }
        }

        // <!--  location  -->
        // $location = session()->get('location');
        // if ($location) {

        //     $region = array_key_exists("region", $location) ? $location['region'] : '';
        //     $country = array_key_exists("country", $location) ? $location['country'] : '';
        //     $address = Str::slug($region . '-' . $country);

        //     $ad->update([
        //         'address' => $address,
        //         'neighborhood' => array_key_exists("neighborhood", $location) ? $location['neighborhood'] : '',
        //         'locality' => array_key_exists("locality", $location) ? $location['locality'] : '',
        //         'place' => array_key_exists("place", $location) ? $location['place'] : '',
        //         'district' => array_key_exists("district", $location) ? $location['district'] : '',
        //         'postcode' => array_key_exists("postcode", $location) ? $location['postcode'] : '',
        //         'region' => array_key_exists("region", $location) ? $location['region'] : '',
        //         'country' => array_key_exists("country", $location) ? $location['country'] : '',
        //         'long' => array_key_exists("lng", $location) ? $location['lng'] : '',
        //         'lat' => array_key_exists("lat", $location) ? $location['lat'] : '',
        //     ]);
        //     session()->forget('location');
        // }

        if ($request->cancel_edit) {
            $this->forgetStepSession();
            return redirect()->route('frontend.dashboard');
        } else {
            return view('frontend.postad.postsuccess', [
                'ad_slug' => $ad->slug,
                'mode' => 'update',
            ]);
        }
    }

    /**
     * Update Ad step 3.
     * @param Request $request
     * @return void
     */
    public function updatePostStep3(Request $request, Ad $ad)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $ad->update(['description' => $request->description]);

        // feature inserting
        $ad->adFeatures()->delete();
        foreach ($request->features as $feature) {
            if ($feature) {
                $ad->adFeatures()->create(['name' => $feature]);
            }
        }

        // image uploading
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                if ($image && $image->isValid()) {

                    $url = uploadImage($image, 'adds_multiple', true);
                    $ad->galleries()->create(['image' => $url]);
                }
            }
        }

        $this->forgetStepSession();
        $this->adNotification($ad, 'update');

        return view('frontend.postad.postsuccess', [
            'ad_slug' => $ad->slug,
            'mode' => 'update',
        ]);

        // return view('frontend.postad.custom-field-edit', compact('ad'));

    }

    /**
     * Cancel Ad Edit.
     * @return void
     */
    public function cancelAdPostEdit()
    {
        $this->forgetStepSession();
        return redirect()->route('frontend.dashboard');
    }

    public function adGalleryDelete($ad_gallery)
    {
        // return $ad_gallery;
        $data = AdGallery::find($ad_gallery);
        $res = $data->delete();
        $res = true;

        if ($res) {
            @unlink($data->image);
            $result['status'] = 'success';
            $result['message'] = 'Image deleted successfully';
        } else {
            $result['status'] = 'failed';
            $result['message'] = 'Image not deleted successfully';
        }

        return response()->json($result);
    }

    protected function updateCustomField($request, Ad $ad)
    {
        $category = Category::with('customFields.values')->FindOrFail($ad->category_id);
        $fields = $ad->productCustomFields;

        foreach ($fields as $fld) {
            // dd($field->slug);
            $field = CustomField::findOrFail($fld->custom_field_id);
            // dd($field->slug);
            if ($field->slug !== $request->has($field->slug) && $field->required) {
                if ($field->type != 'checkbox' && $field->type != 'checkbox_multiple') {
                    $request->validate([
                        $field->slug => 'required',
                    ]);
                }
            }
            if ($field->type == 'textarea') {
                $request->validate([
                    $field->slug => 'max:255',
                ]);
            }
            if ($field->type == 'url') {
                $request->validate([
                    $field->slug => 'url',
                ]);
            }
            if ($field->type == 'number') {
                $request->validate([
                    $field->slug => 'numeric',
                ]);
            }
            if ($field->type == 'date') {
                $request->validate([
                    $field->slug => 'date',
                ]);
            }
        }

        // First Delete If Custom Field Value exist for this Ad
        $field_values = ProductCustomField::where('ad_id', $ad->id)->get();
        foreach ($field_values as $item) {

            if (file_exists($item->value)) {
                unlink($item->value);
            }
            $item->delete();
        }

        $checkboxFields = [];
        if (request()->filled('cf')) {
            $checkboxFields = request()->get('cf');
        }

        // Checkbox Fields
        if ($checkboxFields) {
            foreach ($checkboxFields as $key => $values) {
                $CustomField = CustomField::findOrFail($key)->load('customFieldGroup');

                if (gettype($values) == 'array') {
                    $imploded_value = implode(", ", $values);

                    $ad->productCustomFields()->create([
                        'custom_field_id' => $key,
                        'value' => $imploded_value,
                        'custom_field_group_id' => $CustomField->custom_field_group_id,
                    ]);
                } else {
                    $ad->productCustomFields()->create([
                        'custom_field_id' => $key,
                        'value' => $values ?? '0',
                        'custom_field_group_id' => $CustomField->custom_field_group_id,
                    ]);
                }
            }
        }

        // then insert
        foreach ($category->customFields as $field) {

            if ($field->slug == $request->has($field->slug)) {
                $CustomField = CustomField::findOrFail($field->id)->load('customFieldGroup');

                // check data type for confirm it is image
                $fileType = gettype(request($field->slug));

                if ($fileType == 'object') {
                    $image = uploadImage(request($field->slug), '/custom-field/');
                }

                $ad->productCustomFields()->create([
                    'custom_field_id' => $field->id,
                    'value' => $fileType == 'object' ? $image : request($field->slug),
                    'custom_field_group_id' => $CustomField->custom_field_group_id,
                ]);
            }
        }

        return true;
    }

    public function getSubcategories($category_id)
    {
        // $subcategories = SubCategory::where('category_id', $category_id)->latest()->get()->map(fn ($item) => [
        //     'id' => $item->id,
        //     'name' => $item->name,
        // ]);
        $subcategories = SubCategory::where('category_id', $category_id)->latest()->get();
        $html = '';
        foreach ($subcategories as $key => $item) {
            $scat = str_replace(' ', '_', strtolower($item->name));
            $html .= '<option value="' . $item->id . '"> ' . __($scat) . ' </option>';

        }
        return response()->json($html);
    }

    public function getProductModel(Request $request)
    {
        $models = ProductModel::where('brand_id', $request->brand_id)->get();
        $html = ' <option value="" class="d-none">  ' . __("select_model") .'  </option>';
        foreach ($models as $key => $item) {
            $html .= '<option value="' . $item->id . '"> ' . __($item->name) . ' </option>';
        }
        return response()->json($html);
    }


}
