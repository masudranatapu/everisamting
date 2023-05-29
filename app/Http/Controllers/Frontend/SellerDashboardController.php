<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Modules\Ad\Transformers\AdResource;
use Modules\Review\Entities\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerDashboardController extends Controller
{
    public function profile(User $user)
    {
        if (!session()->has('seller_tab')) {
            session(['seller_tab' => 'ads']);
        }
        // dd($user->id);
        $reviews = Review::where('seller_id', $user->id)->whereStatus(1)->get();

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

        $recent_ads = AdResource::collection($ad_data->paginate(20));
        $total_active_ad = Ad::where('user_id', $user->id)->activeCategory()->active()->count();
        $social_medias = $user->socialMedia;

        return view('frontend.seller.dashboard', compact('recent_ads', 'user', 'rating_details', 'total_active_ad', 'social_medias'));
    }

    public function rateReview(Request $request)
    {
        session(['seller_tab' => 'review_store']);

        $review = DB::table('reviews')->where('user_id', Auth::user()->id)->where('seller_id', $request->seller_id)->get();
        if ($review && $review->count() > 0) {
            return redirect()->back()->with('error', 'You already reviewed this seller.');
        }

        $request->validate([
            'stars' => 'required|numeric|between:1,5',
            'comment' => 'required|string|max:255',
        ]);

        Review::create([
            'seller_id' => $request->seller_id,
            'user_id' => Auth::user()->id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thanks for your valuable review.');
    }

    public function preSignup(Request $request)
    {
        session(['seller_tab' => 'review_store']);

        $request->validate([
            'email' => 'required',
        ]);

        return redirect()->route('frontend.signup', ['email' => $request->email]);
    }

    public function report(Request $request)
    {
        if (!$request->has('reason')) {
            return redirect()->back()->with('error', 'Reason field is required');
        }

        Report::create([
            'report_from_id' => Auth::user()->id,
            'report_to_id' => $request->user_id,
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Report submitted successfully');
    }
}
