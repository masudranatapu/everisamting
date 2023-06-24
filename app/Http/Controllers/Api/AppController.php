<?php

namespace App\Http\Controllers\Api;

use App\Models\Cms;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Faq\Entities\Faq;
use Modules\Plan\Entities\Plan;
use Modules\Brand\Entities\Brand;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaqsResource;
use App\Http\Resources\PlanResource;
use Modules\Contact\Entities\Contact;
use Modules\Faq\Entities\FaqCategory;
use Modules\Faq\Transformers\FaqResource;
use App\Http\Resources\FaqCategoriesResource;
use Illuminate\Support\Facades\Validator;
use Modules\Brand\Transformers\BrandResource;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Location\Transformers\CityResource;
use Modules\Location\Transformers\TownResource;
use Modules\Faq\Transformers\FaqCategoryResource;

class AppController extends Controller
{
    public function testimonialList()
    {

        return Testimonial::latest('id')->get();
    }

    public function cities(Request $request)
    {
        $paginate = $request->paginate ?? false;

        if ($paginate) {
            return CityResource::collection(City::withCount('ads')->latest('ads_count')->simplePaginate($paginate));
        } else {
            return CityResource::collection(City::withCount('ads')->latest('ads_count')->get());
        }

        $cities = City::latest()->paginate(10);

        return response()->json($cities);
    }

    public function citiesTowns(City $city)
    {
        $towns = $city->towns()->get();

        return TownResource::collection($towns);
    }

    public function contactMessage(Request $request)
    {



        $validate = Validator::make($request->all(), [
            'name' => 'required|max:120',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10',
        ]);

        $discription = [
            'name' => 'must be string max charecters 120',
            'email' => 'must be email',
            'subject' => 'must be string',
            'message' => 'must be string minimum carecter 10 and miximum carecter 200'
        ];



        if ($validate->fails()) {
            return sendError( $validate->errors()->first(),"validation arror",200,$discription);
        }




        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        if ($contact) {
            return sendResponse(200, "Message Send Successfully", [], true, $discription);
        } else {
            return sendError("Something went wrong", "Submit Error",200,$discription);
        }
    }

    public function faqsCategory()
    {
        $faqs_categories = FaqCategory::with(['faqs'])->latest()->get();

        return sendResponse(200, "FAQ Categories With Faq", $faqs_categories, true, null);
    }

    public function categoriesFaq(FaqCategory $category)
    {

        $discription = "Must provide A Faq Category id";

        $faqs = Faq::where('faq_category_id', $category->id)->latest()->get();

        return sendResponse(200, "Faq Category", $faqs, true, $discription);
    }

    public function contactContent()
    {
        $contactData = Cms::select('contact_number', 'contact_number', 'contact_address')->first();

        if ($contactData) {

            return sendResponse(200, "Contact Page Content", $contactData, true, null);
        } else {

            return sendError("Something Wrong", "Data not found");
        }
    }

    public function postingrulesContent()
    {

        $posting_rules = Cms::select("posting_rules_background", "posting_rules_body")->first();

        if ($posting_rules) {

            return sendResponse(200, "Posting Roles", $posting_rules, true, []);
        } else {

            return sendError([], "No Data Found");
        }
    }

    public function aboutContent()
    {
        $about = Cms::select("about_video_thumb", "about_background", "about_body")->first();
        $about = Cms::select("about_video_thumb", "about_background", "about_body")->first();
        // $cities = City::count();
        // $towns = Town::count();
        $verified_users = User::where('email_verified_at', '!=', null)->count();
        $published_ads = Ad::activeCategory()->active()->count();

        if ($about) {
            $data = [
                'about_content' => $about,
                'published_ads_count' => $published_ads,
                'verified_users_count' => $verified_users,
                // 'cities_count' => $cities,
                // 'towns_count' => $towns,
                // 'total_cities_towns_count' => $cities + $towns,
            ];
            return sendResponse(200, "About Us Content", $data, true, []);
        } else {

            return sendError("No Data Found", [], 200);
        }
    }

    public function brands()
    {
        $brands = Brand::latest()->get();

        return BrandResource::collection($brands);
    }

    public function planList()
    {
        $plans =  Plan::all();
        Log::alert($plans);
        return sendResponse(200, "Price Plan List", PlanResource::collection($plans), true, null);
    }

    public function generateToken(Request $request)
    {
        try {
            auth('api')->user()->update(['fcm_token' => $request->token]);

            return response()->json([
                'token' => $request->token,
                'message' => 'Token Generated Successfully',
                'user' => auth('api')->user(),
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function termsConditions()
    {
        $trm = Cms::select(['terms_body', 'terms_background'])->first();
        return sendResponse(200, "terms Conditions", $trm, true, []);
    }

    /**
     * View Privacy Policy page
     *
     * @return void
     */
    public function privacy()
    {
        $privacyPolicy = Cms::select(['privacy_body', 'privacy_background'])->first();
        return sendResponse(200, 'Privacy Policy Page Content', $privacyPolicy, true, null);
    }
}
