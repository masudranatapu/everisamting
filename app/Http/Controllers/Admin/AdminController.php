<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AdminSearch;
use App\Models\Transaction;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Post;
use Modules\Plan\Entities\Plan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }


    public function dashboard()
    {
        session(['layout_mode' => 'left_nav']);

        $customers = User::all();
        $ads = Ad::all();

        $data['total_earning'] = currencyConversion(Transaction::where('payment_status', 'paid')->sum('amount'), 'USD', config('zakirsoft.currency'));
        $data['customer'] = $customers->count();
        $data['verified_customers'] = $customers->whereNotNull('email_verified_at')->count();
        $data['adcount'] = $ads->count();
        $data['adcountActive'] = $ads->where('status', 'active')->count();
        $data['adcountPending'] = $ads->where('status', 'pending')->count();
        $data['adcountExpired'] = $ads->where('status', 'sold')->count();
        $data['adcountFeatured'] = $ads->where('featured', 1)->count();
        $countryCount =  DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();
        $data['totalCountry'] = $countryCount->count();
        $data['blogpostCount'] = Post::count();
        $data['total_plan'] = Plan::count();

        $data['latestAds'] = Ad::select(['id', 'slug', 'price', 'status', 'title'])->orderBy('id', 'DESC')->limit(10)->get();
        $data['latestusers'] = User::select(['id', 'name', 'email', 'created_at', 'username'])->orderBy('id', 'DESC')->limit(10)->get();
        $data['latestTransactionUsers'] = Transaction::with(['customer:id,name,email,username', 'plan:id,label,price'])->limit(10)->get();

        $data['topLocations'] = DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('country')
            ->limit(10)
            ->get();

        $months = Transaction::select(
            \DB::raw('MIN(created_at) AS created_at'),
            \DB::raw('sum(amount) as `amount`'),
            \DB::raw("DATE_FORMAT(created_at,'%M') as month")
        )
            ->where("created_at", ">", \Carbon\Carbon::now()->startOfYear())
            ->orderBy('created_at')
            ->groupBy('month')
            ->get();


        $data['earnings'] = $this->formatEarnings($months);

        return view('admin.index', $data);
    }

    private function formatEarnings(object $data)
    {
        $amountArray = [];
        $monthArray = [];

        foreach ($data as $value) {
            array_push($amountArray, $value->amount);
            array_push($monthArray, $value->month);
        }

        return ['amount' => $amountArray, 'months' => $monthArray];
    }

    public function search(Request $request)
    {

        $pages = AdminSearch::where('page_title', 'LIKE', "%$request->data%")->limit(10)->get();

        return response()->json(['pages' => $pages]);
    }
}
