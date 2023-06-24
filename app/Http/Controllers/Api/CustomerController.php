<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomerPlanResource;
use App\Http\Resources\CustomerNotificationResource;
use App\Http\Resources\InvoiceMobileResource;
use App\Http\Traits\MobileTrait;
use App\Models\BusinessDirectory;
use App\Models\Event;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdResourceMobile;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use mysql_xdevapi\Exception;

class CustomerController extends Controller
{
    use MobileTrait;

    public function passwordUpdate(Request $request)
    {


        $customer = User::findOrFail(auth()->guard('api')->id());

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $discription = [
            'current_password' => 'Must be string and minimum carecter is 8',
            'password' => 'Must be string and minimum carecter is 8',
            'password_confirmation' => 'Must be string and minimum carecter is 8',
        ];


        if ($validator->fails()) {
            return sendError("Validation Error", [$discription, $validator->errors()]);
        }

        $password_check = Hash::check($request->current_password, $customer->password);

        if ($password_check) {
            $customer->update(['password' => bcrypt($request->password)]);

            return sendResponse(200, "Password Updated", null, true, $discription);
        } else {
            return sendError("Something Error", $discription);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $user_id = auth()->guard('api')->id();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$user_id}",
            'phone' => "sometimes|nullable",
            'web' => "sometimes|nullable|url",
            'image' => "sometimes|nullable",
            'hide_my_email'=>"sometimes",
            'received_email_update'=>"sometimes",
            'hide_my_phone'=>"sometimes",
            'opening_hour'=>"required",
            'closing_hours'=>"required",
            'about_public_profile'=>'required',
            'username'=>'required',
        ]);

        $discription = [
            'name' => 'Must Be string',
            'email' => "Must be string and it should be email",
            'phone' => "must be string",
            'web' => "Must be string it should be url with http or https",
            'image' => "image should be base64 code",
            'show_email'=>'Must be boolean value',
            'receive_email'=>'Must be boolean value',
            'show_phone'=>'Must be boolean value',
            'opening_hour'=>'Must be time value',
            'closing_hour'=>'Must be time value',
            'about_public_profile'=>"Must be Text",
            'username'=>"Must be Text"

        ];

        if ($validator->fails()) {

            return sendError("Validation Error", [$discription, $validator->errors()],);
            // return response()->json($validator->errors());
        }

        try {
            $base64 = $request->base64 ?? true;
            $customer = User::find(auth()->guard('api')->id());

            $customer->update($request->except(['image', 'base64']));

            if ($base64 && $request->image) {
                $url = uploadBase64FileToPublic($request->image, 'uploads/customer/');
                $customer->update(['image' => $url]);
            } else {
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $url = $request->image->move('uploads/customer', $request->image->hashName());
                    $customer->update(['image' => $url]);
                }
            }

            if ($customer) {

                return sendResponse(200, "Profile Update successfully", $customer, true, $discription);
            }
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return sendError("Something went wrong", [$e->getTraceAsString(), $discription]);
        }
    }

    public function allAds(Request $request)
    {
        $filter = $request->filter;
        $sort = $request->sort;
        $paginate = $request->paginate ?? false;

        $ads = Ad::with('category', 'subcategory', 'customer', 'brand', 'adFeatures', 'galleries', 'productCustomFields')->whereUserId(auth()->guard('api')->id());

        if ($filter == 'active') {
            $ads = $ads->whereStatus('active');
        } elseif ($filter == 'sold') {
            $ads = $ads->whereStatus('sold');
        }

        if ($sort == 'latest') {
            $ads = $ads->latest('id');
        } elseif ($sort == 'popular') {
            $ads = $ads->latest('total_views');
        } elseif ($sort == 'featured') {
            $ads = $ads->where('featured', 1);
        }

        if ($paginate) {
            $ads = $ads->orderBy('id', 'desc')->paginate($paginate)->withQueryString();
        } else {
            $ads = $ads->orderBy('id', 'desc')->paginate($paginate)->withQueryString();
        }
        $discription = [
            'paginate' => "Optional peram,Must be number, default value 10",
            'filter' => "Optional peram,Must be active or sold, default null",
            'sort' => "Optional peram,Must be latest or popular or featured , default null",
        ];

        return sendResponse(200, "Ad List", $ads, true, $discription);
        // return response()->json(['discription' => $discription, 'ads' => $ads]);
    }

    public function recentAds(Request $request)
    {
        $paginate = $request->paginate ?? false;

        $recent_ads = Ad::customerData(true)->with('category')->orderBy('id', 'desc');

        if ($paginate) {
            $recent_ads = $recent_ads->simplePaginate($paginate);
        } else {
            $recent_ads = $recent_ads->get();
        }

        return AdResourceMobile::collection($recent_ads);
    }

    public function activeAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Ad is already sold'
            ], Response::HTTP_ACCEPTED);
        }

        if ($ad->status != 'sold') {
            return response()->json([
                'success' => false,
                'message' => 'Ad is already active'
            ], Response::HTTP_ACCEPTED);
        }

        $ad->update([
            'status' => 'active'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ad mark as active'
        ], Response::HTTP_OK);
    }

    public function expireAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not allowed to do this action'
            ], Response::HTTP_FORBIDDEN);
        }

        if ($ad->status != 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Ad is already sold'
            ], Response::HTTP_ACCEPTED);
        }

        $ad->update([
            'status' => 'sold'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ad mark as sold'
        ], Response::HTTP_OK);
    }

    public function deleteAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return sendError('Validation Error', 'You are not allowed to do this action');
        }

        $ad->delete();
        $this->addeleteNotification();

        return sendResponse(200, "Ad Delete Successfully", [], true);
    }

    public function deleteCustomer()
    {
        $customer = User::find(auth()->guard('api')->id());
        $customer->username = "deleted_" . $customer->id . $customer->username;
        $customer->email = "deleted_" . $customer->id . $customer->email;
        $customer->save();
        auth()->guard('api')->logout();
        return sendResponse(200, "Account deleted successfully", '', true, "");


        // return response()->json([
        //     'success' => true,
        //     'message' => ''
        // ], Response::HTTP_OK);
    }

    public function favouriteAddRemove(Ad $ad = null)
    {

        if (isset($ad)) {


            $customer = auth()->guard('api')->user();

            $data = Wishlist::where('ad_id', $ad->id)->whereUserId($customer->id)->first();


            $discription = ['ad' => 'peram must be ad id as integer'];

            if ($data) {

                $data->delete();
                $favouriteAddList = Wishlist::where('user_id', $customer->id)->get();

                // if (checkSetup('mail')) {
                //     $customer->notify(new AdWishlistNotification($customer, 'add', $ad->slug));
                // }

                // return response()->json([
                //     'success' => true,
                //     'message' => 'Ad removed from wishlist'
                // ], Response::HTTP_OK);

                return sendResponse(200, "Ad removed from wishlist", $favouriteAddList, true, $discription);
            } else {

                Wishlist::create([
                    'ad_id' => $ad->id,
                    'user_id' => $customer->id
                ]);
                $favouriteAddList = Wishlist::where('user_id', $customer->id)->get();

                // if (checkSetup('mail')) {
                //     $customer->notify(new AdWishlistNotification($customer, 'add', $ad->slug));
                // }

                // return response()->json([
                //     'success' => true,
                //     'message' => 'Ad added to wishlist'
                // ], Response::HTTP_OK);

                return sendResponse(200, "Ad added to wishlist", $favouriteAddList, true, $discription);
            }
        } else {
            return sendError("Vaidation Error", "Must provide an ad id");
        }
    }


    public function recentInvoice()
    {
        return InvoiceMobileResource::collection(Transaction::with('plan:id,label')->customerData(true)->latest()->get()->take(5));
    }

    public function favouriteAds(Request $request)
    {


        $ads = Wishlist::with('ad')->where('user_id', auth()->guard('api')->id())->latest()->get();


        return sendResponse(200, "User Favourite Ads", $ads, true, []);
    }

    public function activityLogs()
    {

        $notifications = User::find(auth()->guard('api')->id())->notifications()->latest()->limit(5)->get();

        return CustomerNotificationResource::collection($notifications);
    }

    public function dashboardOverview(Request $request)
    {
        $ads = Ad::customerData(true)->get();
        $posted_ads_count = $ads->count();
        $expire_ads_count = $ads->where('status', 'sold')->count();
        $active_ads_count = $ads->where('status', 'active')->count();
        $favourite_count = Wishlist::whereUserId(auth()->guard('api')->id())->count();

        $bar_chart_datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        for ($i = 0; $i < 12; $i++) {
            $bar_chart_datas[$i] = (int)Ad::customerData(true)
                ->select('total_views')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i + 1)
                ->sum('total_views');
        }

        $plan = new CustomerPlanResource(auth()->guard('api')->user()->userPlan);
        $notifications = User::find(auth()->guard('api')->id())->notifications()->latest()->limit(5)->get();

        $paginate = $request->paginate ?? false;

        $recent_ads = Ad::with('category', 'subcategory', 'customer', 'brand', 'adFeatures', 'galleries')->where('user_id', auth()->guard('api')->id())
            ->active()->latest('id');

        if ($paginate) {
            $recent_ads = $recent_ads->paginate($paginate)->withQueryString();
        } else {
            $recent_ads = $recent_ads->paginate(5)->withQueryString();
        }


        $data = [
            'ads_count' => [
                'posted_ads_count' => $posted_ads_count,
                'active_ads_count' => $active_ads_count,
                'expire_ads_count' => $expire_ads_count,
                'favourite_ads_count' => $favourite_count,

            ],
            'month_wise_views' => $bar_chart_datas,
            'plan' => $plan,
            'actovity_log' => $notifications,
            'recentAdd' => $recent_ads,
        ];

        $discription = [
            'paginate' => "Optional peram ,must be number default value 16"
        ];

        return sendResponse(200, "Dashboard Overview", $data, true, $discription);
    }

    public function adsViewsSummery()
    {
        $bar_chart_datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        for ($i = 0; $i < 12; $i++) {
            $bar_chart_datas[$i] = (int)Ad::customerData(true)
                ->select('total_views')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i + 1)
                ->sum('total_views');
        }

        return response()->json([
            'success' => true,
            'data' => [
                'month_wise_views' => $bar_chart_datas
            ]
        ], Response::HTTP_OK);
    }

    public function planLimit()
    {

        return response()->json([
            'success' => true,
            'plan' => new CustomerPlanResource(auth()->guard('api')->user()->userPlan)
        ], Response::HTTP_OK);
    }

    public function planUpgradeTesting(Request $request)
    {
        auth()->guard('api')->user()->userPlan->update([
            'ad_limit' => $request->ad_limit,
            'featured_limit' => $request->featured_limit,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Plan updated successfully',
            'plan' => new CustomerPlanResource(auth('api')->user()->userPlan) ?? null,
        ], Response::HTTP_OK);
    }

    public function planHistory()
    {
        $transactions = Transaction::with('plan')->customerData(true)->latest()->get()->take(5);
        return sendResponse(200, 'User Plan History', $transactions, true, []);
    }

    public function socialUpdate(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'social_media.*' => 'required|string',
            'url.*' => 'required|string'
        ]);

        $discription = [
            'social_media' => "Must be string",
            'url' => "Must be string web url with http or https"
        ];

        if ($validator->fails()) {
            return sendError("Validation Error", [$discription, $validator->errors()]);
        }

        $user = User::find(auth()->guard('api')->id());

        $user->socialMedia()->delete();
        // $user->socialMedia()->createMany($request->all());

        $social_medias = $request->social_media;
        $urls = $request->url;

        foreach ($social_medias as $key => $value) {
            if ($value) {
                $user->socialMedia()->create([
                    'social_media' => $social_medias[$key],
                    'url' => $urls[$key],
                ]);
            }
        }

        $socialmedia = $user->socialMedia;

        return sendResponse(200, "Social media has been updated", $socialmedia, true, $discription);
    }

    public function pamentgetways()
    {
        $getways = [
            'paypal' => config('paypal'),
            'stripe' => [
                'stripe_key' => config('zakirsoft.stripe_key'),
                'stripe_secret' => config('zakirsoft.stripe_secret'),
                'active' => config('zakirsoft.stripe_active'),
            ]

        ];
        return sendResponse(200, "Payment Getways", $getways, true, []);
    }


    public function businessDirectoryStore(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phone_2' => 'sometimes',
            'address' => 'required',
            'business_profile_link' => 'required|url',
            'description' => 'required',
            'thumbnail' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $discription = [
            'title' => 'must be string',
            'category_id' => 'must be category id',
            'email' => 'must be string & email',
            'phone' => 'must be number',
            'phone_2' => 'must be number',
            'address' => 'must be string',
            'business_profile_link' => 'must be string',
            'description' => 'must be string',
            'thumbnail' => 'must be base64 string',
            'lat' => 'must be float number',
            'lng' => 'must be float number',

        ];


        if ($validator->fails()) {
            return sendError($validator->errors()->first(),"Validation Error");
        }


        DB::beginTransaction();
        try {
            $businessdirectoryimage = $request->thumbnail;
            if ($businessdirectoryimage) {
                Log::alert($businessdirectoryimage);

                $upload_path = 'uploads/businessdirectory/';
                $image_url = uploadBase64FileToPublic($businessdirectoryimage, $upload_path);
                Log::alert($image_url);
            }

            $categoryArr = explode(', ', trim($request->category_id, '[]'));


            $business = BusinessDirectory::create([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'user_id' => auth()->guard('api')->user()->id,
                'category_id' => $categoryArr,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'status' => 'pending',
                'address' => $request->address,
                'business_profile_link' => $request->business_profile_link,
                'lat' => $request->lat ?? '',
                'lang' => $request->lng ?? '',
                'description' => $request->description,
                'map' => $map ?? '',
                'created_at' => Carbon::now(),
                'thumbnail' => $image_url ?? null,
            ]);
            Log::alert($business);

            $checkuserplan = DB::table('user_plans')->where('user_id', auth()->guard('api')->user()->id)->first();


            DB::table('user_plans')->where('user_id', auth()->guard('api')->user()->id)->update([
                'business_directory_limit' => $checkuserplan->business_directory_limit - 1,
            ]);
        } catch (\Throwable $th) {

            DB::rollback();
            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
            return $data;
            return sendError("Validation Error", $data);
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Business directory created successfully!';
        return sendResponse(200, 'Business directory save successfully', $data, true, $discription);
    }

    public function businessDirectoryUpdate(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phone_2' => 'sometimes',
            'address' => 'required',
            'business_profile_link' => 'required|url',
            'description' => 'required',
        ]);

        $discription = [
            'title' => 'must be string',
            'category_id' => 'must be category id',
            'email' => 'must be string & email',
            'phone' => 'must be number',
            'phone_2' => 'must be number',
            'address' => 'must be string',
            'business_profile_link' => 'must be string',
            'description' => 'must be string',

        ];


        if ($validator->fails()) {
            return sendError("Validation Error", [$discription, $validator->errors()->first()]);
        }


        DB::beginTransaction();
        try {
            $businessdirectoryimage = $request->thumbnail;
            if ($businessdirectoryimage) {
                Log::alert($businessdirectoryimage);

                $upload_path = 'uploads/businessdirectory/';
                $image_url = uploadBase64FileToPublic($businessdirectoryimage, $upload_path);
                Log::alert($image_url);
            }

            $categoryArr = explode(', ', trim($request->category_id, '[]'));
            $old_data = DB::table('ads_business_directory')->where('id', $id)->first();


            $business = BusinessDirectory::where('id', $id)->update([
                'title' => $request->title,
                'user_id' => auth()->guard('api')->user()->id,
                'category_id' => $categoryArr,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'status' => 'pending',
                'address' => $request->address,
                'business_profile_link' => $request->business_profile_link,
                'lat' => $request->lat ?? '',
                'lang' => $request->lng ?? '',
                'description' => $request->description,
                'map' => $map ?? '',
                'created_at' => Carbon::now(),
                'thumbnail' => $image_url ?? $old_data->thumbnail,
            ]);
            Log::alert($business);

            $checkuserplan = DB::table('user_plans')->where('user_id', auth()->guard('api')->user()->id)->first();


            DB::table('user_plans')->where('user_id', auth()->guard('api')->user()->id)->update([
                'business_directory_limit' => $checkuserplan->business_directory_limit - 1,
            ]);
        } catch (\Throwable $th) {
            Log::alert($th);
            DB::rollback();
            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
            return $data;
            return sendError("Validation Error", $data);
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Business directory created successfully!';
        return sendResponse(200, 'Bussiness directory save siccessfully', $data, true, $discription);
    }

    public function businessDirectoryDelete($id)
    {
        $item = BusinessDirectory::find($id);
        if (File::exists($item->thumbnail)) {
            File::delete($item->thumbnail);
        }
        $item->delete();
        $data['success'] = true;
        $data['message'] = 'Business directory deleted successfully!';
        return sendResponse(200, $data['message'], [], true, []);
    }

    public function userEvent(Request $request)
    {
        try {

        $events = Event::with('venue')
            ->where('user_id', Auth::guard('api')->id())->latest('id')->get();
        return sendResponse(200, 'User Events', $events, true, []);
        }catch (Exception $e){
            return sendError("Exception Error",$e->getMessage());
        }
    }


    public function eventStore(Request $request)
    {

        $organiser_id = json_decode($request->organisers, true);

        Log::alert($request->all());

        foreach ($organiser_id as $value) {
            if ($value['id'] == 0) {
                if (!isset($value['name'])) {

                    return sendError("Validation Error", ['name' => 'name field is required']);
                }
                if (!isset($value['email'])) {

                    return sendError("Validation Error", ['email' => 'email field is required']);
                }
                if (!isset($value['phone'])) {

                    return sendError("Validation Error", ['phone' => 'phone field is required']);
                }
                if (!isset($value['website'])) {
                    return sendError("Validation Error", ['website' => 'website field is required']);
                }
            }
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'details' => 'required',
            'short_description' => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "category_id" => 'required',
            "tag_id" => 'required',
            "venue_id" => 'required',
            "venue_name" => 'required_if:venue_id,create_new_venue',
            "venue_address" => 'required_if:venue_id,create_new_venue',
            "organisers" => 'required',

        ]);
        if ($validator->fails()) {
            return sendError("Validation Error", $validator->errors()->first());
        }

        $discription = [
            'title' => 'must be string',
            'details' => 'must be string',
            'short_description' => 'must be string max char limit 250',
            "venue_id" => 'must be venue id',
            "venue_name" => 'must be string of select to create new venue',
            "venue_address" => 'must be string of select to create new venue',
            "organisers" => 'required',
            "start_date" => 'Start date is required',
            "end_date" => 'End date is required',
            "category_id" => 'Category id is required',
            "tag_id" => 'Tag id is required',

        ];


        DB::beginTransaction();
        try {

            if ($request->venue_id == "create_new_venue") {
                if ($request->venue_name) {
                    $venueid = DB::table('event_venues')->insertGetId([
                        'name' => $request->venue_name,
                        'address' => $request->venue_address ?? '',
                        'city' => $request->venue_city ?? '',
                        'country' => $request->venue_country ?? '',
                        'state' => $request->venue_state ?? '',
                        'postal_code' => $request->venue_postal_code ?? '',
                        'phone' => $request->venue_phone ?? '',
                        'website' => $request->venue_website ?? '',
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'created_by' => auth()->guard('api')->user()->id,
                    ]);
                }
            } else {
                $venueid = $request->venue_id ?? null;
            }

            $event_image = $request->file('image');
            if (isset($request->image)) {

                $image_url = uploadBase64FileToPublic($request->image, 'uploads/event/');
            }

            if ($request->wheelchair) {
                $wheelchair = 1;
            } else {
                $wheelchair = 0;
            }

            if ($request->accessible) {
                $accessible = 1;
            } else {
                $accessible = 0;
            }

            if ($request->all_day_event_status) {
                $alldayeventstatus = 1;
            } else {
                $alldayeventstatus = 0;
            }

            $organiser_id_arr = [];


            if ($organiser_id) {
                asort($organiser_id);
            }

            if ($organiser_id) {
                foreach ($organiser_id as $value) {
                    if ($value['id'] == 0) {


                        $insert_organiser_id = DB::table('event_organiser')->insertGetId([
                            'name' => $value['name'] ?? '',
                            'email' => $value['email'] ?? '',
                            'phone' => $value['phone'] ?? '',
                            'website' => $value['website'] ?? '',
                            'status' => 0,
                            'created_at' => Carbon::now(),
                            'created_by' => auth()->guard('api')->user()->id,
                        ]);
                        array_push($organiser_id_arr, $insert_organiser_id);
                    } else {
                        foreach ($organiser_id as $value) {
                            array_push($organiser_id_arr, $value['id']);
                        }
                    }
                }
            }

            $category_id = explode(', ', trim($request->category_id, '[]'));
            $tag_id = explode(', ', trim($request->tag_id, '[]'));
            DB::table('events')->insert([
                'user_id' => auth()->guard('api')->user()->id,
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'short_description' => $request->short_description,
                'details' => $request->details,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                // 'timezone' => $request->timezone,
                'all_day_event_status' => $alldayeventstatus,
                'image' => $image_url ?? '',
                'category_id' => json_encode($category_id),
                'tag_id' => json_encode($tag_id),
                'event_status' => $request->event_status,
                'event_status_reason' => $request->event_status_reason,
                'status' => 0,
                'venue_id' => $venueid,
                'organiser_id' => json_encode($organiser_id_arr),
                'wheelchair' => $wheelchair,
                'accessible' => $accessible,
                'event_info_link' => $request->event_info_link,
                'cost' => $request->cost,
                'created_at' => Carbon::now(),
                'created_by' => auth()->guard('api')->user()->id,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
            return $data;
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Event created successfully!';
        return sendResponse(200, $data['message'], [], true, $discription);
    }

    public function eventUpdate(Request $request, $id)
    {

        $organiser_id = json_decode($request->organisers, true);

        Log::alert($request->all());

        foreach ($organiser_id as $value) {
            if ($value['id'] == 0) {
                if (!isset($value['name'])) {

                    return sendError("Validation Error", ['name' => 'name field is required']);
                }
                if (!isset($value['email'])) {

                    return sendError("Validation Error", ['email' => 'email field is required']);
                }
                if (!isset($value['phone'])) {

                    return sendError("Validation Error", ['phone' => 'phone field is required']);
                }
                if (!isset($value['website'])) {
                    return sendError("Validation Error", ['website' => 'website field is required']);
                }
            }
        }


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'details' => 'required',
            'short_description' => 'required',
        ]);
        if ($validator->fails()) {
            return sendError("Validation Error", $validator->errors()->first());
        }

        $discription = [
            'title' => 'must be string',
            'details' => 'must be string',
            'short_description' => 'must be string max char limit 250',
        ];


        DB::beginTransaction();
        try {

            if ($request->venue_id == "create_new_venue") {
                if ($request->venue_name) {
                    $venueid = DB::table('event_venues')->insertGetId([
                        'name' => $request->venue_name,
                        'slug' => strtolower(str_replace(' ', '-', $request->venue_name)),
                        'address' => $request->venue_address ?? '',
                        'city' => $request->venue_city ?? '',
                        'country' => $request->venue_country ?? '',
                        'state' => $request->venue_state ?? '',
                        'postal_code' => $request->venue_postal_code ?? '',
                        'phone' => $request->venue_phone ?? '',
                        'website' => $request->venue_website ?? '',
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'created_by' => auth()->guard('api')->user()->id,
                    ]);
                }
            } else {
                $venueid = $request->venue_id ?? null;
            }

            $event_image = $request->file('image');
            if (isset($request->image)) {

                $image_url = uploadBase64FileToPublic($request->image, 'uploads/event/');
            }

            if ($request->wheelchair) {
                $wheelchair = 1;
            } else {
                $wheelchair = 0;
            }

            if ($request->accessible) {
                $accessible = 1;
            } else {
                $accessible = 0;
            }

            if ($request->all_day_event_status) {
                $alldayeventstatus = 1;
                $starttime = NULL;
                $endttime = NULL;
            } else {
                $alldayeventstatus = 0;
                $starttime = $request->start_time;
                $endttime = $request->end_time;
            }

            if ($request->event_status == 2 || $request->event_status == 3) {
                $eventstatusreason = $request->event_status_reason;
            } else {
                $eventstatusreason = NULL;
            }

            $organiser_id_arr = [];

            $organiser_id = $request->organiser_id;
            // dd($organiser_id);

            if ($organiser_id) {
                asort($organiser_id);
            }

            if ($organiser_id) {
                foreach ($organiser_id as $key => $value) {
                    if ($value == 'create_new_organiser') {
                        if ($request->organiser_name) {
                            foreach ($request->organiser_name as $key1 => $organiser) {
                                if ($organiser != '') {
                                    $insert_organiser_id = DB::table('event_organiser')->insertGetId([
                                        'name' => $request->venue_name[$key1] ?? '',
                                        'email' => $request->organiser_email[$key1] ?? '',
                                        'phone' => $request->organiser_phone[$key1] ?? '',
                                        'website' => $request->organiser_website[$key1] ?? '',
                                        'status' => 0,
                                        'created_at' => Carbon::now(),
                                        'created_by' => auth()->guard('api')->user()->id,
                                    ]);
                                    array_push($organiser_id_arr, $insert_organiser_id);
                                }
                            }
                        }

                        break;
                    } else {

                        array_push($organiser_id_arr, $value);
                    }
                }
            }

            $event = DB::table('events')->where('id', $id)->first();
            $category_id = explode(', ', trim($request->category_id, '[]'));
            $tag_id = explode(', ', trim($request->tag_id, '[]'));

            DB::table('events')->where('id', $id)->update([
                'user_id' => auth()->guard('api')->user()->id,
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'short_description' => $request->short_description,
                'details' => $request->details,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                // 'timezone' => $request->timezone,
                'all_day_event_status' => $alldayeventstatus,
                'image' => $image_url ?? $event->image,
                'category_id' => json_encode($category_id),
                'tag_id' => json_encode($tag_id),
                'event_status' => $request->event_status,
                'event_status_reason' => $request->event_status_reason,
                'status' => 0,
                'venue_id' => $venueid,
                'organiser_id' => json_encode($organiser_id_arr),
                'wheelchair' => $wheelchair,
                'accessible' => $accessible,
                'event_info_link' => $request->event_info_link,
                'cost' => $request->cost,
                'created_at' => Carbon::now(),
                'created_by' => auth()->guard('api')->user()->id,
            ]);
        } catch (\Throwable $th) {
            Log::alert($th);
            DB::rollback();
            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
            return $data;
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Event updated successfully!';
        return sendResponse(200, $data['message'], [], true, $discription);
    }

    public function eventDelete($id)
    {
        $event = Event::find($id);
        if (File::exists($event->image)) {
            File::delete($event->image);
        }
        $event->delete();
        $data['success'] = true;
        $data['message'] = 'Event deleted successfully!';
        return sendResponse(200, $data['message'], [], true, []);
    }

    public function contactAuthor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'message' => 'required',
            'post_id' => 'required'
        ]);
        $discription = [
            'email' => 'must be string and email',
            'message' => 'must be string',
            'post_id' => 'ads business directory id'
        ];

        if ($validator->fails()) {
            return sendError("Validation Error", [$discription, $validator->errors()->first()]);
        }

        DB::beginTransaction();
        try {

            $businessdirectoryinfo = DB::table('ads_business_directory')->where('id', $request->post_id)->first();

            $user = User::find(auth()->guard('api')->id());

            $customerinfo = User::find($businessdirectoryinfo->user_id);

            $details = [
                'name' => $businessdirectoryinfo->title,
                'title' => 'Contact for business directory information',
                'customer' => $customerinfo->name,
                'user' => $user->name,
                'email' => $request->email,
                'body' => $request->message,
            ];

            DB::table('contact_author')->insert([
                'author_id' => $businessdirectoryinfo->user_id,
                'post_id' => $request->post_id,
                'email' => $businessdirectoryinfo->email,
                'message' => $request->message,
                'mail_sent' => 1,
                'created_by' => auth()->guard('api')->id(),
                'created_at' => Carbon::now(),
            ]);

            Mail::to($businessdirectoryinfo->email)->send(new \App\Mail\BusinessDirectoryMail($details));
        } catch (\Throwable $th) {
            DB::rollback();

            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Your message successfully sent to author.';

        return sendResponse(200, $data['message'], [], true, $discription);
    }

    public function userBusinessDirectories(Request $request)
    {
        $user = auth('api')->user();
        if ($user) {
            if (isset($request->paginate)) {
                $paginate = $request->paginate;
            } else {
                $paginate = 10;
            }
            $discription = [
                'paginate' => 'optional param must be integer default value 10',
                'sort' => 'optional param must be word az,za,popular,newest_to_oldest,oldest_to_newest',
                'category' => 'optional param must be category id',
                'keyword' => 'optional param must be string',
                'location' => 'optional param must be string'
            ];
            $categories = Category::where('type', 2)->get();

            $ads = BusinessDirectory::where('user_id', $user->id);
            if ($request->sort) {
                if ($request->sort == 'az') {
                    $ads->orderBy('title', 'ASC');
                } else if ($request->sort == 'za') {
                    $ads->orderBy('title', 'DESC');
                } else if ($request->sort == 'popular') {
                    $ads->orderBy('total_views', 'desc');
                } else if ($request->sort == 'newest_to_oldest') {
                    $ads->orderBy('created_at', 'ASC');
                } else if ($request->sort == 'oldest_to_newest') {
                    $ads->orderBy('created_at', 'DESC');
                }
            }

            if ($request->category) {
                $cate_slug = DB::table('categories')->where('slug', $request->category)->first();
                if ($cate_slug) {
                    $cateid = $cate_slug->id;
                } else {
                    $cateid = null;
                }

                if ($cateid) {
                    $ads->whereJsonContains('category_id',$cateid);
                }
            }

            if ($request->keyword) {
                $keywords = explode(' ', $request->keyword);
                $ads->whereRaw("MATCH (title)
              against (? in boolean mode)", [$keywords]);
            }

            if ($request->location) {
                $locations = explode(' ', $request->location);
                $ads->whereRaw("MATCH (address)
              against (? in boolean mode)", [$locations]);
            }

            $ads = $ads->orderBy('id', 'desc')->paginate($paginate)->withQueryString();


            $businessDirectories = $ads;
            foreach ($businessDirectories as $bus) {
                $bus->categories = Category::findMany($bus->category_id);
            }
            return sendResponse(200, "Business Directories", $businessDirectories, true, $discription);
        } else {
            return sendError("No user found");
        }
    }

    public function businessClim($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120',
            'email' => 'required|email',
        ], [
            'name.required' => "Name field are required",
            'email.required' => "Email field are required",
            'email.email' => "Email must be a valid email",
        ]);

        if ($validator->fails()) {
            return sendError("Validation error.", $validator->errors());
        } else {
            DB::table('business_claim')->insert([
                'ad_id' => $id,
                'name' => $request->name,
                'email' => $request->email,
                'created_by' => auth('api')->user()->id,
                'created_at' => Carbon::now(),
                'status' => 0,
            ]);
        }

        return sendResponse(200, "Business claim successfully received", [], true, []);
    }

    public function report(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'report_to' => "required",
            'reason' => "required",

        ]);
        if ($validate->fails()){
            return sendError("Validation Error",$validate->errors()->first());
        }
        $seller=User::where('username',$request->report_to)->first();
        if(!isset($seller)){
            return sendError("Invalid","Seller not found");
        }

        $reportDetails=Report::where('report_from_id' , Auth::guard('api')->id())->where('report_to_id' , $seller->id)->first();

        if (isset($reportDetails)){
            return sendError("Invalid","Already Reported To This Seller");
        }

        $report=Report::create([
            'report_from_id' => Auth::guard('api')->id(),
            'report_to_id' => $seller->id,
            'reason' => $request->reason,
        ]);

        return sendResponse(200, 'Report submitted successfully',$report);
    }
}
