<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CmsSettingController extends Controller
{
    public function index()
    {
        if (!userCan('setting.view')) {
            return abort(403);
        }

        session('cms_part') ?? session(['cms_part' => 'home']);

        $cms = Cms::first();
        return view('admin.settings.pages.cms', compact('cms'));
    }

    /**
     * Update posting rules text
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postingRulesUpdate(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        session(['cms_part' => 'posting_rules']);

        $cms =  Cms::first();
        if ($request->hasFile('posting_rules_background') && $request->file('posting_rules_background')->isValid()) {
            deleteImage($cms->posting_rules_background);
            $url = $request->posting_rules_background->move('uploads/banners', $request->posting_rules_background->hashName());
            $cms->update($request->only('posting_rules_body') + ['posting_rules_background' => $url]);
        } else {
            $request->validate([
                'posting_rules_body'    =>  ['required']
            ]);
            $cms->update($request->only('posting_rules_body'));
        }

        return redirect()->back()->with('success', 'Posting rules update successfully!');
    }

    /**
     * About information update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateAbout(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'about']);

        $cms =  Cms::first();
        $rules = ['about_body'    =>  ['required']];
        $data = $request->only('about_body');

        if ($request->hasFile('about_video_thumb') && $request->file('about_video_thumb')->isValid()) {
            deleteImage($cms->about_video_thumb);
            $data['about_video_thumb'] =  $request->about_video_thumb->move('uploads/banners', $request->about_video_thumb->hashName());
        }
        if ($request->hasFile('about_background') && $request->file('about_background')->isValid()) {
            deleteImage($cms->about_background);
            $data['about_background'] =  $request->about_background->move('uploads/banners', $request->about_background->hashName());
        }

        $request->validate($rules);
        $cms->update($data);

        return redirect()->back()->with('success', 'About update successfully!');
    }

    /**
     * Terms information update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateTerms(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'terms']);

        $cms = Cms::first();

        if ($request->hasFile('terms_background') && $request->file('terms_background')->isValid()) {
            deleteImage($cms->terms_background);
            $url = $request->terms_background->move('uploads/banners', $request->terms_background->hashName());
            $cms->update($request->only('terms_body') + ['terms_background' => $url]);
        } else {
            $request->validate([
                'terms_body'    =>  ['required']
            ]);
            $cms->update($request->only('terms_body'));
        }

        return redirect()->back()->with('success', 'Term & Condition update successfully!');
    }

    /**
     * privacy information update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePrivacy(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'privacy']);

        $cms =  Cms::first();
        if ($request->hasFile('privacy_background') && $request->file('privacy_background')->isValid()) {
            deleteImage($cms->privacy_background);
            $url = $request->privacy_background->move('uploads/banners', $request->privacy_background->hashName());
            $cms->update($request->only('privacy_body') + ['privacy_background' => $url]);
        } else {
            $request->validate([
                'privacy_body'    =>  ['required']
            ]);
            $cms->update($request->only('privacy_body'));
        }

        return redirect()->back()->with('success', 'Privacy Policy update successfully!');
    }


    /**
     * Update Home page static images
     *
     * @@author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateHome(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'home']);

        $cms =  Cms::first();
        $data = [];

        if ($request->hasFile('home_main_banner') && $request->file('home_main_banner')->isValid()) {
            deleteImage(DB::table('cms')->first()->home_main_banner);
            // dd($cms->home_main_banner);
            $request->home_main_banner->move('uploads/banners', $request->home_main_banner->getClientOriginalName());
            $data['home_main_banner'] =  'uploads/banners/'. $request->home_main_banner->getClientOriginalName();
        }
        if ($request->hasFile('home_counter_background') && $request->file('home_counter_background')->isValid()) {
            deleteImage($cms->home_counter_background);
            $data['home_counter_background'] =  $request->home_counter_background->move('uploads/banners', $request->home_counter_background->hashName());
        }
        if ($request->hasFile('home_mobile_app_banner') && $request->file('home_mobile_app_banner')->isValid()) {
            deleteImage($cms->home_mobile_app_banner);
            $data['home_mobile_app_banner'] =  $request->home_mobile_app_banner->move('uploads/banners', $request->home_mobile_app_banner->hashName());
        }

        // dd($data['home_main_banner']);
        $data['home_title'] = $request->home_title;
        $data['home_title_chinese'] = $request->home_title_chinese;
        $data['home_title_french'] = $request->home_title_french;
        $data['home_title_bislama'] = $request->home_title_bislama;
        $data['home_description'] = $request->home_description;
        $data['home_description_chinese'] = $request->home_description_chinese;
        $data['home_description_french'] = $request->home_description_french;
        $data['home_description_bislama'] = $request->home_description_bislama;
        $data['download_app'] = $request->download_app;
        $data['newsletter_content'] = $request->newsletter_content;
        $data['membership_content'] = $request->membership_content;
        $data['create_account'] = $request->create_account;
        $data['post_ads'] = $request->post_ads;
        $data['start_earning'] = $request->start_earning;

        $cms->update($data);

        return redirect()->back()->with('success', 'Home Settings update successfully!');
    }

    /**
     * Update Get Membership Page static images
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateGetMembership(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'membership']);

        $cms =  Cms::first();
        $data = [];

        if ($request->hasFile('get_membership_background') && $request->file('get_membership_background')->isValid()) {
            deleteImage($cms->get_membership_background);
            $data['get_membership_background'] =  $request->get_membership_background->move('uploads/banners', $request->get_membership_background->hashName());
        }
        if ($request->hasFile('get_membership_image') && $request->file('get_membership_image')->isValid()) {
            deleteImage($cms->get_membership_image);
            $data['get_membership_image'] =  $request->get_membership_image->move('uploads/banners', $request->get_membership_image->hashName());
        }

        $cms->update($data);

        return redirect()->back()->with('success', 'Get Membership Settings update successfully!');
    }



    /**
     * Update Pricing Plan Static Images
     *
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updatePricingPlan(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'price_plan']);

        if ($request->hasFile('pricing_plan_background') && $request->file('pricing_plan_background')->isValid()) {
            $cms =  Cms::first();
            deleteImage($cms->pricing_plan_background);
            $url = $request->pricing_plan_background->move('uploads/banners', $request->pricing_plan_background->hashName());
            $cms->update(['pricing_plan_background' => $url]);
        }

        return redirect()->back()->with('success', 'Pricing Plan Settings update successfully!');
    }


    /**
     * Update Faqs static Images
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function updateFaq(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'faq']);

        $cms =  Cms::first();
        $data = [];

        if ($request->hasFile('faq_background') && $request->file('faq_background')->isValid()) {
            deleteImage($cms->faq_background);
            $url =  $request->faq_background->move('uploads/banners', $request->faq_background->hashName());
            $cms->update(['faq_background' => $url]);
        }

        $data['faq_content'] = $request->faq_content;
        $cms->update($data);

        return redirect()->back()->with('success', 'Faqs Settings update successfully!');
    }

    /**
     * Update DAshboard static Images
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function updateDashboard(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'dashboard']);

        $cms =  Cms::first();
        $rules = [];
        $data = [];

        if ($request->hasFile('dashboard_overview_background') && $request->file('dashboard_overview_background')->isValid()) {
            deleteImage($cms->dashboard_overview_background);
            $data['dashboard_overview_background'] = $request->dashboard_overview_background->move('uploads/banners', $request->dashboard_overview_background->hashName());
        }
        if ($request->hasFile('dashboard_post_ads_background') && $request->file('dashboard_post_ads_background')->isValid()) {
            deleteImage($cms->dashboard_post_ads_background);
            $data['dashboard_post_ads_background'] = $request->dashboard_post_ads_background->move('uploads/banners', $request->dashboard_post_ads_background->hashName());
        }

        if ($request->hasFile('dashboard_my_ads_background') && $request->file('dashboard_my_ads_background')->isValid()) {
            deleteImage($cms->dashboard_my_ads_background);
            $data['dashboard_my_ads_background'] = $request->dashboard_my_ads_background->move('uploads/banners', $request->dashboard_my_ads_background->hashName());
        }
        if ($request->hasFile('dashboard_favorite_ads_background') && $request->file('dashboard_favorite_ads_background')->isValid()) {
            deleteImage($cms->dashboard_favorite_ads_background);
            $data['dashboard_favorite_ads_background'] = $request->dashboard_favorite_ads_background->move('uploads/banners', $request->dashboard_favorite_ads_background->hashName());
        }
        if ($request->hasFile('dashboard_messenger_background') && $request->file('dashboard_messenger_background')->isValid()) {
            deleteImage($cms->dashboard_messenger_background);
            $data['dashboard_messenger_background'] = $request->dashboard_messenger_background->move('uploads/banners', $request->dashboard_messenger_background->hashName());
        }

        if ($request->hasFile('dashboard_plan_background') && $request->file('dashboard_plan_background')->isValid()) {
            deleteImage($cms->dashboard_plan_background);
            $data['dashboard_plan_background'] = $request->dashboard_plan_background->move('uploads/banners', $request->dashboard_plan_background->hashName());
        }
        if ($request->hasFile('dashboard_account_setting_background') && $request->file('dashboard_account_setting_background')->isValid()) {
            deleteImage($cms->dashboard_account_setting_background);
            $data['dashboard_account_setting_background'] = $request->dashboard_account_setting_background->move('uploads/banners', $request->dashboard_account_setting_background->hashName());
        }

        $cms->update($data);

        return redirect()->back()->with('success', 'Dashboard Settings update successfully!');
    }




    /**
     * Update Blog Background Image
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateBlog(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'blog']);

        if ($request->hasFile('blog_background') && $request->file('blog_background')->isValid()) {
            $cms =  Cms::first();
            deleteImage($cms->blog_background);
            $url =  $request->blog_background->move('uploads/banners', $request->blog_background->hashName());
            $cms->update(['blog_background' => $url]);
        }

        return redirect()->back()->with('success', 'Blog Settings update successfully!');
    }



    /**
     * Update Ads Background Image
     *
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     * @param Request $request
     * @return void
     */
    public function updateAds(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'ads']);

        if ($request->hasFile('ads_background') && $request->file('ads_background')->isValid()) {
            $cms =  Cms::first();
            deleteImage($cms->ads_background);
            $url =  $request->ads_background->move('uploads/banners', $request->ads_background->hashName());
            $cms->update(['ads_background' => $url]);
        }

        return redirect()->back()->with('success', 'Ads Settings update successfully!');
    }


    /**
     * Update Contact Background Image
     *
     * @author Mithun Halder <mithunrptc@gmail.com>
     *
     * @param Request $request
     * @return void
     */
    public function updateContact(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'contact']);

        $cms =  Cms::first();
        $cms->contact_number = $request->contact_number;
        $cms->contact_email = $request->contact_email;
        $cms->contact_address = $request->contact_address;
        if ($request->hasFile('contact_background') && $request->file('contact_background')->isValid()) {
            deleteImage($cms->contact_background);
            $url =  $request->contact_background->move('uploads/contacts', $request->contact_background->hashName());
            $cms->update(['contact_background' => $url]);
        }
        $cms->save();

        return redirect()->back()->with('success', 'Contact Settings update successfully!');
    }

    public function updateAuthContent(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        session(['cms_part' => 'auth']);

        $cms =  Cms::first();
        $data = [];

        $data['manage_ads_content'] = $request->manage_ads_content;
        $data['chat_content'] = $request->chat_content;
        $data['verified_user_content'] = $request->verified_user_content;
        $cms->update($data);

        return redirect()->back()->with('success', 'Content updated successfully!');
    }

    public function updateComingSoon(Request $request){
        if (!userCan('setting.update')) {
            return abort(403);
        }

        session(['cms_part' => 'c_soon']);

        $request->validate([
            'coming_soon_title' => 'required|max:255',
            'coming_soon_subtitle' => 'required|max:255'
        ]);

        $cms = Cms::first();
        $cms->coming_soon_title = $request->coming_soon_title;
        $cms->coming_soon_subtitle = $request->coming_soon_subtitle;
        $cms->save();

        return redirect()->back()->with('success', 'Content updated successfully!');
    }

    public function updateMaintenance(Request $request){
        if (!userCan('setting.update')) {
            return abort(403);
        }

        session(['cms_part' => 'maintenance']);

        $request->validate([
            'maintenance_title' => 'required|max:255',
            'maintenance_subtitle' => 'required|max:255'
        ]);

        $cms = Cms::first();
        $cms->maintenance_title = $request->maintenance_title;
        $cms->maintenance_subtitle = $request->maintenance_subtitle;
        $cms->save();

        return redirect()->back()->with('success', 'Content updated successfully!');
    }

    public function updateErrorPages(Request $request){
        if (!userCan('setting.update')) {
            return abort(403);
        }

        session(['cms_part' => 'errorpages']);

        $request->validate([
            'e404_title' => 'sometimes|max:255',
            'e404_subtitle' => 'sometimes|max:255',
            'e500_title' => 'sometimes|max:255',
            'e500_subtitle' => 'sometimes|max:255',
            'e503_title' => 'sometimes|max:255',
            'e503_subtitle' => 'sometimes|max:255',
        ]);

        $cms = Cms::first();
        $cms->e404_title = $request->e404_title;
        $cms->e404_subtitle = $request->e404_subtitle;
        if ($request->hasFile('e404_image')) {
            deleteImage($cms->e404_image);
            $url = $request->e404_image->move('uploads/errorpages', $request->e404_image->hashName());
            $cms->update(['e404_image' => $url]);
        }
        $cms->e500_title = $request->e500_title;
        $cms->e500_subtitle = $request->e500_subtitle;
        if ($request->hasFile('e500_image')) {
            deleteImage($cms->e500_image);
            $url = $request->e500_image->move('uploads/errorpages', $request->e500_image->hashName());
            $cms->update(['e500_image' => $url]);
        }
        $cms->e503_title = $request->e503_title;
        $cms->e503_subtitle = $request->e503_subtitle;
        if ($request->hasFile('e503_image')) {
            deleteImage($cms->e503_image);
            $url = $request->e503_image->move('uploads/errorpages', $request->e503_image->hashName());
            $cms->update(['e503_image' => $url]);
        }
        $cms->save();

        return redirect()->back()->with('success', 'Content updated successfully!');
    }
}
