<?php

namespace Modules\Review\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Modules\Review\Entities\Review;
use Modules\Product\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Modules\Order\Entities\OrderProduct;
use Modules\Review\Http\Requests\CreateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!userCan('review.view'), 403);

        $customers = User::all();
        $products = Product::all();

        $reviews_query = Review::query();

        if ($request->has('customer') && !is_null($request->customer)) {
            $reviews_query->where('user_id', $request->customer);
        }

        if ($request->has('product') && !is_null($request->product)) {
            $reviews_query->where('product_id', $request->product);
        }

        if ($request->has('stars') && !is_null($request->stars)) {
            $reviews_query->where('stars', $request->stars);
        }

        if ($request->has('sort_by') && !is_null($request->sort_by)) {
            $request->sort_by == 'latest' ? $reviews_query->latest('id') : $reviews_query->oldest('id');
        }

        $reviews = $reviews_query->paginate(10);

        return view('review::index', compact('reviews', 'customers', 'products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        abort_if(!userCan('review.delete'), 403);

        try {
            $review->delete();

            flashSuccess('Review Deleted Successfully');
            return back();
        } catch (\Exception $e) {
            flashError();
            return back();
        }
    }

    public function statusChange(Request $request)
    {
        abort_if(!userCan('review.update'), 403);

        try {
            Review::findOrFail($request->id)->update([
                'status' => $request->status
            ]);

            if ($request->status == 1) {
                return responseSuccess('Review Active Successfully');
            } else {
                return responseSuccess('Review Inactive Successfully');
            }
        } catch (\Throwable $th) {
            return responseError();
        }
    }
}
