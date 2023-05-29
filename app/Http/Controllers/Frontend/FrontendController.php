<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Cms;
use App\Models\User;
use App\Models\Event;
use AmrShawky\Currency;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\EventTags;
use App\Models\EventVenue;
use App\Models\BlogComment;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use App\Models\EventOrganiser;
use App\Models\PaymentSetting;
use App\Models\EventCategories;
use Modules\Blog\Entities\Post;
use Modules\Plan\Entities\Plan;
use App\Models\BusinessDirectory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Modules\Faq\Entities\FaqCategory;
use Modules\Newsletter\Entities\Email;
use Modules\Ad\Transformers\AdResource;
use Modules\Blog\Entities\PostCategory;
use Modules\Category\Entities\Category;
use App\Notifications\LogoutNotification;
use Modules\Testimonial\Entities\Testimonial;
use App\Services\Midtrans\CreateSnapTokenService;
use Modules\Category\Transformers\CategoryResource;
use Modules\CustomField\Entities\ProductCustomField;

class FrontendController extends Controller
{
    use RegistersUsers;
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

        $data['topCategories'] = collectionToResource($topCategories);

        $data['topCountry'] = DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('country')
            ->limit(6)
            ->get();

        $data['totalAds'] = Ad::activeCategory()->active()->count();

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
        $ads = $ad_data->get();
        $categories = CategoryResource::collection(Category::active()->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->where('type', 1)->get());
        $recommendedAds = $ad_data->where('featured', true)->take(12)->latest()->get();
        $latestAds = Ad::activeCategory()->with(['customer', 'category:id,name,icon'])->active()->where('featured', '!=', 1)->take(12)->latest()->get();




        $data['ads'] = collectionToResource($ads);
        $data['categories'] = collectionToResource($categories);
        $data['recommendedAds'] = collectionToResource($recommendedAds);
        $data['latestAds'] = collectionToResource($latestAds);

        $data['verified_users'] = User::whereNotNull('email_verified_at')->count();

        $countryCount =  DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();
        $data['country_location'] = $countryCount->count();

        $data['pro_members_count'] = User::whereHas('userPlan', function ($q) {
            $q->where('badge', true);
        })->count();

        return view('frontend.index', $data);
    }


    /**
     * Return homepage 2 layouts views
     *
     * @param Array $data
     *
     * @return View
     */
    public function homePage2($data)
    {
        $categories = CategoryResource::collection(Category::active()->withCount('ads as ad_count')->latest()->get());
        $recentads = AdResource::collection(Ad::activeCategory()->with('category', 'customer')->active()->latest('id')->get()->take(4));
        $featured_ad_data = Ad::activeCategory()->with(['customer', 'category:id,name,icon',])->active()->take(6)->latest()->get();
        $featuredad = AdResource::collection($featured_ad_data);
        $latestAds = AdResource::collection(Ad::activeCategory()->with(['customer', 'category:id,name,icon'])->active()->where('featured', '!=', 1)->take(6)->latest()->get());

        $data['categories'] = collectionToResource($categories);
        $data['featuredAds'] = collectionToResource($featuredad);
        $data['latestAds'] = collectionToResource($latestAds);
        $data['recentads'] = $recentads;

        $data['total_ads'] = Ad::activeCategory()->active()->count();

        return view('frontend.index_02', $data);
    }

    /**
     * Return homepage 3 layouts views
     *
     * @param Array $data
     * @return View
     */
    public function homePage3($data)
    {
        $categories = CategoryResource::collection(Category::active()->latest()->get());
        $plans = Plan::all();
        $featured_ad_data = Ad::activeCategory()->with(['customer', 'category:id,name,icon',])->active()->take(8)->latest()->get();
        $featuredad = AdResource::collection($featured_ad_data);
        $latestAds = AdResource::collection(Ad::activeCategory()->with(['customer', 'category:id,name,icon'])->active()->where('featured', '!=', 1)->take(8)->latest()->get());

        $data['featuredAds'] = collectionToResource($featuredad);
        $data['latestAds'] = collectionToResource($latestAds);
        $data['categories']  =  collectionToResource($categories);

        $data['plans']  = $plans;
        $data['total_ads'] = Ad::activeCategory()->active()->count();

        return view('frontend.index_03', $data);
    }


    /**
     * View Testimonial page
     *
     * @param  Testimonial
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function about()
    {
        $testimonials = Testimonial::latest('id')->get();
        $cms = Cms::select(['about_body', 'about_video_thumb', 'about_background'])->first();
        return view('frontend.about', compact('testimonials', 'cms'));
    }


    public function businessDirectories(Request $request)
    {
        $categories = Category::active()->where('type', 2)->get();

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
//            dd($cateid);

            if ($cateid) {
                $ads->whereJsonContains('category_id',json_encode($cateid));
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

        $ads = $ads->paginate(30);
        foreach($ads as $ad){
            $ad->categories = Category::findMany($ad->category_id);
        }
//        dd($ads);

        return view('frontend.business_directories', compact('ads', 'categories'));
    }

    public function businessDetails($id, $slug)
    {
        $view = DB::table('ads_business_directory')->where('id', $id)->first();

        DB::table('ads_business_directory')->where('id', $id)->update([
            'total_views' => $view->total_views + 1,
        ]);

        $categories = Category::where('type', 2)->get();

        $ad = BusinessDirectory::where('id', $id)->first();

        return view('frontend.business_details', compact('ad', 'categories'));
    }

    public function contactAuthor(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'message' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $businessdirectoryinfo = DB::table('ads_business_directory')->where('id', $request->post_id)->first();

            $user = User::find(auth('user')->id());

            $seller = User::find($businessdirectoryinfo->user_id);
            if ($seller){
                $customerinfo = $seller;
            }else{
                $customerinfo = Admin::first();
            }

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
                'created_by' => auth('user')->id(),
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

        return redirect()->back()->with($data['status'], $data['message']);
    }

    public function businessDirectoryClaim(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'myemail' => 'required',
        ], [
            'name.required' => 'Name filed is required',
            'myemail.required' => 'Email filed is required',
        ]);

        if ($validation->passes()) {

            DB::table('business_claim')->insert([
                'ad_id' => $request->ad_id,
                'email' => $request->myemail,
                'name' => $request->name,
                'created_at' => Carbon::now(),
                'created_by' => auth('user')->id() ?? null,
                'status' => 0,

            ]);

            $result = 1;

            return response()->json(['success' => 'Business claim successfully received', 'result' => $result]);
        } else {

            $result = 0;
            return response()->json(['errors' => $validation->errors()->all(), 'result' => $result]);
        }
    }


    /**
     * View Faq page
     *
     *  @param  Faq
     * @return void
     */
    public function faq()
    {
        if (!enableModule('faq')) {
            abort(404);
        }
        $category_slug = request('category') ?? FaqCategory::first()->slug;
        $category = FaqCategory::where('slug', $category_slug)->first();
        $data['categories'] = FaqCategory::latest()->get(['id', 'name', 'slug', 'icon']);
        $data['faqs'] = Faq::where('faq_category_id', $category->id)->with('faq_category:id,name,icon')->get();

        return view("frontend.faq", $data);
    }

    /**
     * View Contact page
     *
     * @return void
     */
    public function contact()
    {
        if (!enableModule('contact')) {
            abort(404);
        }
        return view('frontend.contact');
    }

    /**
     * View Single Ad page
     *
     * @return void
     */
    public function adDetails(Ad $ad)
    {
        if ($ad->status == 'pending') {
            if ($ad->user_id != auth('user')->id()) {
                abort(404);
            }
        }

        $verified_seller = User::findOrFail($ad->user_id)->email_verified_at;
        $ad->increment('total_views');
        $ad = $ad->load(['customer', 'brand', 'adFeatures', 'galleries', 'productCustomFields.customField']);

        $lists = Ad::activeCategory()
            ->with(['category', 'productCustomFields' => function ($q) {
                $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                    $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                        ->where('listable', 1)
                        ->oldest('order')
                        ->without('customFieldGroup');
                }])->latest();
            }])
            ->where('category_id', $ad->category_id)
            ->where('id', '!=', $ad->id)
            ->active()
            ->latest('id')->take(10)->get();

        $product_custom_field_groups = $ad->productCustomFields->groupBy('custom_field_group_id');
        // dd($product_custom_field_groups);

        if ($ad->status === 'sold' && $ad->customer->id !== auth('user')->id()) {
            abort(404);
        } else {
            return view('frontend.single-ad', compact('ad', 'lists', 'verified_seller', 'product_custom_field_groups'));
        }
    }

    /**
     * View ad list page
     *
     * @return void
     */
    public function adList()
    {
        $data['adlistings'] = Ad::activeCategory()
            ->with(['category:id,name', 'productCustomFields' => function ($q) {
                $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                    $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                        ->where('listable', 1)
                        ->oldest('order')
                        ->without('customFieldGroup');
                }])->latest();
            }])
            ->latest('id')
            ->active()
            ->paginate(21)->onEachSide(1);
        $data['categories'] = Category::active()->where('type', 1)->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->where('type', 1)->latest('id')->get();
        $data['adMaxPrice'] = $price = DB::table('ads')->max('price');
        // Check if the "mobile" word exists in User-Agent
        $data['isMob'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));

        // Check if the "tablet" word exists in User-Agent
        $data['isTab'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));


        // Check if the "mobile" word exists in User-Agent
        $data['isWin'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
        // Check if the "tablet" word exists in User-Agent
        $data['isMac'] = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mac"));


        return view('frontend.ad-list', $data);
    }

    /**
     * View Get membership page
     *
     * @return void
     */
    public function getMembership()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $data['plans'] = Plan::latest()->get();
        return view('frontend.get-membership', $data);
    }

    /**
     * View Priceplan page
     *
     * @return void
     */
    public function pricePlan()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $plans = Plan::all();
        return view('frontend.price-plan', compact('plans'));
    }

    // Event
    public function event(Request $request)
    {

        $categories = DB::table('event_categories')->where('status', 1)->get();
        $tags = DB::table('event_tags')->where('status', 1)->get();
        $venues = DB::table('event_venues')->where('status', 1)->get();

        $searching_name = $request->search;
        $searching_date = $request->date;
        $query = Event::where('event_status', 1)->where('status', 1)->where('event_status', 1)->latest('id');

        if (isset($searching_name)) {
            $query->where('title', 'LIKE', '%' . $searching_name . '%')->orWhere('created_at', 'LIKE', '%' . $searching_date . '%');
        }

        if ($request->venue) {
            $query->where('venue_id', $request->venue);
        }
//        dd($request->date);

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


        return view('frontend.event.event_list', compact('events', 'categories', 'tags', 'venues'));
    }
    public function getEvent(Request $request)
    {
        $searching_name = $request->search;
        $results = Event::where('event_status', 1)->where('status', 1)->where('event_status', 1)->where('title', 'LIKE', '%' . $searching_name . '%')->get();
//        dd($results);
        $html = view('frontend.event.search', compact('results'))->render();
        return response()->json($html);
    }

    public function eventCategory($id, $slug)
    {

        $categories = DB::table('event_categories')->where('status', 1)->get();
        $tags = DB::table('event_tags')->where('status', 1)->get();
        $venues = DB::table('event_venues')->where('status', 1)->get();
        $events = Event::where('status', 1)->whereJsonContains('category_id', $id)->where('event_status', 1)->latest()->paginate(8);

        return view('frontend.event.event_list', compact('events', 'categories', 'tags', 'venues'));
    }

    public function eventTags($id, $slug)
    {
        $categories = DB::table('event_categories')->where('status', 1)->get();
        $tags = DB::table('event_tags')->where('status', 1)->get();
        $venues = DB::table('event_venues')->where('status', 1)->get();
        $events = Event::where('status', 1)->whereJsonContains('tag_id', $id)->where('event_status', 1)->latest()->paginate(8);

        return view('frontend.event.event_list', compact('events', 'categories', 'tags', 'venues'));
    }

    public function eventCrate(Request $request)
    {
        if (!auth('user')->check()) {
            return redirect()->route('users.login');
        }

        $event_cat = EventCategories::where('status', 1)->orderBy('name', 'asc')->get();
        $event_tag = EventTags::where('status', 1)->orderBy('name', 'asc')->get();
        $event_venue = EventVenue::where('status', 1)->orderBy('name', 'asc')->get();
        $event_organiser = EventOrganiser::where('status', 1)->orderBy('name', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();
        $timezoonlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        // dd($countries);
        return view('frontend.event.create', compact('event_cat', 'event_tag', 'event_venue', 'event_organiser', 'countries', 'timezoonlist'));
    }

    public function eventStore(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'details' => 'required',
            'short_description' => 'required|max:250',
            'details' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);

        $event = new Event();

        $store = $event->eventStore($request);

        return redirect()->route('frontend.myevent')->with($store['status'], $store['message']);
    }



    public function eventDetails($id, $slug)
    {
        $categories = DB::table('event_categories')->where('status', 1)->get();
        $tags = DB::table('event_tags')->where('status', 1)->get();
        $venues = DB::table('event_venues')->where('status', 1)->get();
//        dd($venues);
        $events = Event::where('id', $id)->first();

        $related_event = Event::whereJsonContains('category_id', json_decode($events->category_id))->where('id', '!=', $events->id)->get();
        // dd($related_event);
        return view('frontend.event.event_details', compact('events', 'categories', 'tags', 'venues', 'related_event'));
    }

    /**
     * View Signup page
     *
     * @return void
     */
    public function signUp()
    {
        $verified_users = User::where('email_verified_at', '!=', null)->count();

        return view('frontend.sign-up', compact('verified_users'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  Customer
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // dd($request->all());
        $setting = setting();


        if ($request->receive_email) {

            $mailexist = Email::where('email', $request->email)->get();

            if ($mailexist->count() > 0) {
            } else {

                Email::create(['email' => $request->email]);
            }
        }

        $request->validate([
            'name' => "required",
            'username' => "required|unique:users,username",
            'email' => "required|email|unique:users,email",
            'password' => "required|confirmed|min:8|max:50",
        ]);

        $created = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'receive_email' => $request->receive_email ?? 0,
        ]);

        if ($created) {
            Auth::guard('user')->logout();
            Auth::guard('admin')->logout();
            flashSuccess('Registration Successful!');
            Auth::guard('user')->login($created);

            if ($setting->customer_email_verification) {
                $created->sendEmailVerificationNotification();
                return redirect()->route('verification.notice');

            } else {
                return redirect()->route('frontend.dashboard');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function frontendLogout()
    {
        $this->loggedoutNotification();
        auth()->guard('user')->logout();

        return redirect()->route('users.login');
    }

    public function loggedoutNotification()
    {
        // Send login notification
        $user = User::find(auth('user')->id());
        if (checkSetup('mail')) {
            $user->notify(new LogoutNotification($user));
        }
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function blog(Request $request)
    {
        if (!enableModule('blog')) {
            abort(404);
        }

        $query = Post::with('author')->withCount('comments');

        if ($request->has('category') && $request->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        return view('frontend.blog', [
            'blogs' =>  $query->paginate(6)->withQueryString(),
            'recentBlogs' => Post::withCount('comments')->latest()->take(4)->get(),
            'topCategories' => PostCategory::latest()->take(6)->get(),
        ]);
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function singleBlog(Post $blog)
    {
        if (!enableModule('blog')) {
            abort(404);
        }

        $recentPost =  Post::withCount('comments')->latest('id')->take(6)->get();
        $categories = PostCategory::latest()->take(6)->get();
        $blog->load('author', 'category')->loadCount('comments');

        return view('frontend.blog-single', compact('blog', 'categories', 'recentPost'));
    }

    /**
     * View Privacy Policy page
     *
     * @return void
     */
    public function privacy()
    {
        return view('frontend.privacy')->withCms(Cms::select(['privacy_body', 'privacy_background'])->first());
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function terms()
    {
        return view('frontend.terms')->withCms(Cms::select(['terms_body', 'terms_background'])->first());
    }

    /**
     *
     * @param int $post_id
     * @return array
     */
    public function commentsCount($post_id)
    {
        return BlogComment::where('post_id', $post_id)->count();
    }

    /**
     *
     * @param int $post_id
     * @return array
     */
    public function pricePlanDetails($plan_label)
    {
        if (request('email')) {
            $user = User::where('email', request('email'))->firstOrFail();
            Auth::guard('user')->login($user);
        }

        if (!request('email') && !auth('user')->check()) {
            abort(404);
        }

        // session data storing
        $plan = Plan::where('label', $plan_label)->first();
        session(['stripe_amount' => currencyConversion($plan->price) * 100]);
        session(['razor_amount' => currencyConversion($plan->price, null, 'INR', 1) * 100]);
        session(['ssl_amount' => currencyConversion($plan->price, null, 'BDT', 1)]);
        session(['plan' => $plan]);

        // midtrans snap token
        if (config('zakirsoft.midtrans_active') && config('zakirsoft.midtrans_id') && config('zakirsoft.midtrans_key') && config('zakirsoft.midtrans_secret')) {
            $usd = $plan->price;
            $amount = (int) Currency::convert()
                ->from(config('zakirsoft.currency'))
                ->to('IDR')
                ->amount($usd)
                ->round(2)
                ->get();

            $order['order_no'] = uniqid();
            $order['total_price'] = $amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            session(['midtrans_details' => [
                'order_no' => $order['order_no'],
                'total_price' => $order['total_price'],
                'snap_token' => $snapToken,
                'plan_id' => $plan->id,
            ]]);
        }

        return view('frontend.plan-details', [
            'plan' => $plan,
            'mid_token' => $snapToken ?? null,
        ]);
    }

    public function adGalleryDetails(Ad $ad)
    {
        $ad->load('galleries');
        return view('frontend.single-ad-gallery', compact('ad'));
    }

    public function attachmentDownload(Request $request)
    {
        $field = ProductCustomField::with('customField')->FindOrFail($request->field);
        $file = public_path() . $field->value;

        if (file_exists($file)) {

            return response()->download($file);
        }
        flashWarning('File not found .');
        return redirect()->back();
    }

    public function setSession(Request $request)
    {
        if ($request->url) {
            $request->session()->put('location', $request->input());
        } else {
            $request->session()->put('location', $request->input());
        }

        return response()->json($request->input());
    }

    public function mailToCustomer(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:200',
            'message' => 'required',
        ]);
        $details = [
            'customer' => $request->customer_name,
            'user' => Auth::user()->name,
            'title' => $request->subject,
            'body' => $request->message,
        ];

        Mail::to($request->customer_email)->send(new \App\Mail\MyTestMail($details));

        return redirect()->back()->with('success', 'Mail has been sent.');
    }

    public function sellers()
    {
        $sellers = User::withCount('ads as ad_count')->whereHas('ads', function ($query) {
            $query->where('status', 'active');
        })->latest('ad_count')->get();
        return view('frontend.sellers', compact('sellers'));
    }

    public function getEventTooltip(Request $request)
    {
        $id = $request->id;
        $events = Event::find($id);
        $html = '';


        return response()->json(['event' => $events, 'html' => $html]);
    }
}
