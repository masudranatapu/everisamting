<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BusinessDirectory;
use App\Models\Cms;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdResource;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Designation\Entities\Designation;
use Modules\Language\Entities\Language;
use Modules\ProductModel\Entities\ProductModel;
use Modules\Review\Entities\Review;
use Carbon\Carbon;
use Modules\ServiceType\Entities\ServiceType;

class HomeController extends Controller
{
    /**
     * View Home page
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function index()
    {
        $data = [];
        $topCategories = CategoryResource::collection(Category::active()->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->withCount('ads as ad_count')->latest('ad_count')->take(8)->get());
        // $home_page = Theme::first()->home_page;



        $data['topCountry'] = DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('country')
            ->limit(6)
            ->get();



        return $this->homePage1($data);
    }


    /**
     * Return homapge 1 layouts views
     *
     * @param array $data
     *
     * @return View
     */
    public function homePage1($data)
    {
        $ad_data = Ad::activeCategory()->with(['customer', 'category:id,name,icon', 'productCustomFields' => function ($q) {
            $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                    ->where('listable', 1)
                    ->oldest('order')
                    ->without('customFieldGroup');
            }])->latest();
        }])->active();
        $ads = AdResource::collection($ad_data->take(12)->get());
        $categories = CategoryResource::collection(Category::active()->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->orderBy('created_at','desc')->where('type', 1)->get());
        $brands = Brand::all();
        foreach($brands as $brand){
            $brand->models = ProductModel::where('brand_id', $brand->id)->where('status', 1)->get();
        }
        $service_types = ServiceType::where('status', 1)->get();
        $designations = Designation::where('status', 1)->get();
        $recommendedAds = AdResource::collection($ad_data->where('featured', true)->take(12)->latest()->get());
        $latestAds = AdResource::collection(Ad::activeCategory()->with(['customer', 'category', 'subcategory', 'brand', 'adFeatures', 'galleries'])->active()->where('featured', '!=', 1)->take(12)->latest()->get());



        $data['ads'] = collectionToResource($ads);
        $data['categories'] = collectionToResource($categories);
        $data['brands'] = $brands;
        $data['service_types'] = collectionToResource($service_types);
        $data['designations'] = collectionToResource($designations);
        $data['featureAds'] = collectionToResource($recommendedAds);
        $data['latestAds'] = collectionToResource($latestAds);

        $data['verified_users'] = User::whereNotNull('email_verified_at')->count();
        $data['banner'] = Cms::first()->home_main_banner;

        // $countryCount =  DB::table('ads')
        //     ->select('country', DB::raw('count(*) as total'))
        //     ->groupBy('country')
        //     ->get();
        // $data['country_location'] = $countryCount->count();

        // $data['pro_members_count'] = User::whereHas('userPlan', function ($q) {
        //     $q->where('badge', true);
        // })->count();

        return  sendResponse(200, "Home Page", $data, true, null);
        // return response()->json($data);
    }



    public function profile(User $user, Request $request)
    {


        $reviews = Review::with('user')->where('seller_id', $user->id)->whereStatus(1)->get();

        $rating_details = [
            'total' => $reviews->count(),
            'rating' => $reviews->sum('stars'),
            'average' => number_format($reviews->avg('stars')),
        ];

        $ad_data = Ad::where('user_id', $user->id)->activeCategory()->with(['customer', 'category:id,name,icon', 'productCustomFields' => function ($q) {
            $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                    ->where('listable', 1)
                    ->oldest('order')
                    ->without('customFieldGroup');
            }])->latest();
        }])->active()->latest();

        $data['rating_details'] = $rating_details;
        $data['reviews'] = $reviews;
        $data['recent_ads'] = AdResource::collection($ad_data->paginate($request->has('paginate') ? $request->paginate : 10));
        $data['total_active_ad'] = Ad::where('user_id', $user->id)->activeCategory()->active()->count();
        $data['social_medias'] = $user->socialMedia;
        $data['user'] = $user;


        $discription = [
            'paginate' => "Optional peram ,must be number default value 10"
        ];

        return sendResponse(200, "User Public Profile", $data, true, $discription);
    }

    public function seller(Request $request)
    {
        $discription = [
            'paginate' => "Optional peram ,must be number default value 16"
        ];


        $paginate = $request->has('paginate') ? $request->paginate : 16;
        $sellers = User::withCount('reviews')->withAvg('reviews', 'stars')->withCount('ads as ad_count')->whereHas('ads')->latest('ad_count')->paginate($paginate)->withQueryString();

        return sendResponse(200, "Seller List", $sellers, true, $discription);
    }


    public function sellerReview(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stars' => 'required|numeric|between:1,5',
            'comment' => 'required|string|max:255',
        ]);
        $discription = [
            'star' => "Must Be interger between 1 to 5",
            'comment' => "Must be string between 255 character"
        ];

        if ($validator->fails()) {
            return sendError("Validation Error", ['error' => $validator->errors(), 'discription' => $discription]);
        }
        $review = DB::table('reviews')->where('user_id', Auth::guard('api')->id())->where('seller_id', $user->id)->get();
        if ($review && $review->count() > 0) {

            return sendError('Validation Error', "Review Alrady Exist");
        }


        Review::create([
            'seller_id' => $user->id,
            'user_id' => Auth::guard('api')->id(),
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);
        return sendResponse(200, 'Seller Revire', $user, true, []);
    }

    public function getLenguage($code)
    {
        $path = base_path('resources/lang/' . $code . '.json');
        $language = Language::where('code', $code)->first();
        $translations = json_decode(file_get_contents($path), true);
        return sendResponse(200, "lenguage json", $translations, true);
    }

    public function lenguageSync()
    {
        $languages = Language::all();

        $allLen = [];

        foreach ($languages as $key => $language) {
            $path = base_path('resources/lang/' . $language->code . '.json');
            $translations = json_decode(file_get_contents($path), true);
            $allLen[] = [
                "name" => $language->name,
                "code" => $language->code,
                "icon" => $language->icon,
                "direction" => $language->direction,
                "created_at" => $language->created_at,
                "updated_at" => $language->updated_at,
                "json_data" => $translations,
            ];
        }

        return sendResponse('200', "All lenguange with translation", $allLen, true);
    }

    public function businessDirectories(Request $request)
    {
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

        $ads = BusinessDirectory::where('status', 'active');
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
            $keywords   = explode(' ', $request->keyword);
            $ads->whereRaw("MATCH (title)
              against (? in boolean mode)", [$keywords]);
        }

        if ($request->location) {
            $locations   = explode(' ', $request->location);
            $ads->whereRaw("MATCH (address)
              against (? in boolean mode)", [$locations]);
        }

        $ads = $ads->latest('id')->paginate($paginate)->withQueryString();


        $businessDirectories = $ads;
        Log::alert($businessDirectories);
        foreach($businessDirectories as $bus){
            $bus->categories = Category::findMany($bus->category_id);
        }
        return sendResponse(200, "Business Directories", $businessDirectories, true, $discription);
    }



    public function businessDirectoriesCategory(Request $request)
    {
        $categories = CategoryResource::collection(Category::active()->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->where('type', 2)->get());
        return sendResponse(200, "Business Directories", $categories, true, []);
    }

    public function businessDetails($id, $slug)
    {


        $view = DB::table('ads_business_directory')->where('id', $id)->first();

        DB::table('ads_business_directory')->where('id', $id)->update([
            'total_views' => $view->total_views + 1,
        ]);





        return sendResponse(200, "Business Directories Details", $view, true, []);
    }



    public function events(Request $request)
    {

        $discription = [
            'search' => 'must be string',
            'date' => 'must be valid Date',
            'venue' => 'must be vanue Id',
        ];



        $searching_name = $request->search;
        $searching_date = $request->date;
        $query = Event::where('event_status', 1)->where('status', 1)->where('event_status', 1);
        if (isset($searching_name)) {
            $query->where('title', 'LIKE', '%' . $searching_name . '%')->orWhere('created_at', 'LIKE', '%' . $searching_date . '%');
        }

        if ($request->venue) {
            $query->where('venue_id', $request->venue);
        }

        $events = $query->get();
        foreach ($events as $event) {
            if ($event->start_time) {
                $event->start = $event->start_date . ' ' . $event->start_time;
            } else {
                $event->start = $event->start_date;
            }
            if ($event->end_time) {
                $event->end = $event->end_date . ' ' . $event->end_time;
            } else {
                $event->end = $event->end_date;
            }
        }
        return sendResponse(200, "Event", $events, true, $discription);
    }




    public function eventsParams()
    {
        $categories = DB::table('event_categories')->where('status', 1)->get();
        $tags = DB::table('event_tags')->where('status', 1)->get();
        $venues = DB::table('event_venues')->where('status', 1)->get();
        $eventOrganiser = DB::table('event_organiser')->where('status', 1)->get();



        $data = [
            "categories" => $categories,
            "tags" => $tags,
            "venues" => $venues,
            "organiser" => $eventOrganiser,
        ];
        return sendResponse(200, "Event Params", $data, true, []);
    }
    // public function eventsTag()
    // {
    //     return sendResponse(200, "Event Tags", $tags, true, []);
    // }
    // public function eventsVenues()
    // {
    //     return sendResponse(200, "Event Venus", $venues, true, []);
    // }

    // public function eventsOrganiser()
    // {

    //     return sendResponse(200, "Event Venus", $eventOrganiser, true, []);
    // }
}
