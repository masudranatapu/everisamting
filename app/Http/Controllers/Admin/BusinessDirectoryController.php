<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusinessDirectory;
use DOMDocument;
use CArbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BusinessClaim;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\BusinessDirectoryImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Modules\Category\Entities\Category;

class BusinessDirectoryController extends Controller
{

    /**
     * curl_get_contents
     *
     * @param  mixed $url
     * @return void
     */
    public function curl_get_contents($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data) {
            return $data;
        } else {
            return $data = null;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $businessdirectories = BusinessDirectory::latest()->paginate(10);
        foreach ($businessdirectories as $ad){
            $ad->categories = Category::findMany($ad->category_id);
        }
        $businessdirectories_count = DB::table('ads_business_directory')->count();
        return view('admin.businessdirectory.index', compact('businessdirectories', 'businessdirectories_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $data['categories'] = DB::table('categories')->where('type', 2)->get();
        $data['users'] = DB::table('users')->get();

        if ($request->url) {
            try {

                $parse = parse_url($request->url);
                $domain = $parse['host'];
                $website = $this->curl_get_contents($request->url);
                libxml_use_internal_errors(true);
                $dom = new DOMDocument();
                $dom->loadHTML($website);
                // title
                $data['title'] = $this->getElementsByClassName($dom, 'listing-detail_text__31u2P', 'span');

                // details
                $details = $this->getElementsByClassName($dom, 'content-box_body__3tSRB', 'div');
                $string = strip_tags($details);
                $data['details'] = trim(preg_replace('/\s\s+/', ' ', $string));

                // phone

                $phone = $this->getElementsByClassName($dom, 'icon-box-1_module__uyg5F one-text-ellipsis mt-20 mt-sm-15 wil-listing-phone', 'div');
                $phone_dom = new DOMDocument();
                $phone_dom->loadHTML($phone);

                $phone = $this->getElementsByClassName($phone_dom, 'icon-box-1_text__3R39g', 'div');
                $data['phone'] = preg_replace('/[^0-9]/', '', $phone);

                // address

                $map = $this->getElementsByClassName($dom, 'icon-box-1_module__uyg5F one-text-ellipsis mt-20 mt-sm-15 text-pre wil-listing-address', 'div');
                $map_dom = new DOMDocument();
                $map_dom->loadHTML($map);

                $data['address'] = $this->getElementsByClassName($map_dom, 'icon-box-1_text__3R39g', 'div');

                // category
                $cat = $this->getElementsByClassName($dom, 'icon-box-1_module__uyg5F two-text-ellipsis mt-20 mt-sm-15', 'div');
                $cat_dom = new DOMDocument();
                $cat_dom->loadHTML($cat);

                $data['category_name'] = $this->getElementsByClassNameSingle($cat_dom, 'icon-box-1_text__3R39g', 'div');
                // $address = urlencode($data['address']);
                // $api = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false&key=AIzaSyCGYnCh2Uusd7iASDhsUCxvbFgkSifkkTM';

                // $result = file_get_contents($api);
                // dd($result);
                flashSuccess('Data found!');
                // dd($data);
            } catch (\Throwable $th) {

                flashError('Pleas check your url and try agin.');
                // dd($th);
                // return view(
                //     'ad::create',
                //     $data
                // );
            }
        }
        return view('admin.businessdirectory.create', $data);
    }

    public function businessCategorySubcategory($id)
    {
        $subcategory = DB::table('sub_categories')->where('category_id', $id)->get();
        $html = '';
        foreach ($subcategory as $key => $item) {
            $scat = str_replace(' ', '_', strtolower($item->name));
            $html .= '<option value="'. $item->id .'"> '.__($scat).' </option>';

        }
        return response()->json($html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $businessdirectoryimage = $request->file('thumbnail');
            if ($businessdirectoryimage) {

                $upload_path = 'businessdirectory';
                $image_url = uploadAdImage($businessdirectoryimage, $upload_path, 200, 200);
            }
            if (Session::has('location')) {
                $location = session()->get('location');
                $lat = $location['lat'];
                $lang = $location['lng'];
                if (isset($location['url'])) {
                    $map = $location['url'];
                } else {
                    $map = 'https://maps.google.com/?q=' . $location['lat'] . ',' . $location['lng'];
                }
            } else {
                $map = '';
            }

            BusinessDirectory::create([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'status' => $request->status,
                'address' => $request->address,
                'description' => $request->description,
                'business_profile_link' => $request->business_profile_link,
                'map' => $map,
                'lat' => $lat ?? '',
                'lang' => $lang ?? '',
                'created_at' => Carbon::now(),
                'thumbnail' => $image_url ?? null,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            $data['status'] = 'Failed';
            $data['message'] = $th->getMessage();

            return redirect()->back()->with($data['status'], $data['message']);
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Business directory created successfully!';
        Session::forget('location');

        return redirect()->route('business-directory.index')->with($data['status'], $data['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $businessdirectories = BusinessDirectory::find($id);
        $users = DB::table('users')->get();
        $categories = DB::table('categories')->where('type', 2)->get();
        $subcategories = DB::table('sub_categories')->where('type', 2)->get();
        return view('admin.businessdirectory.edit', compact('businessdirectories', 'users', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
//        dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $businessdirectoryimage = $request->file('thumbnail');
            if ($businessdirectoryimage) {

                $upload_path = 'businessdirectory';
                $image_url = uploadAdImage($businessdirectoryimage, $upload_path, 200, 200);
                $old_data = DB::table('ads_business_directory')->where('id', $id)->first();

                if (file_exists($old_data->thumbnail)) {
                    unlink($old_data->thumbnail);
                }
            } else {
                $old_data = DB::table('ads_business_directory')->where('id', $id)->first();
                $image_url = $old_data->thumbnail;
            }

            if (Session::has('location')) {
                $location = session()->get('location');
                $lat = $location['lat'];
                $lang = $location['lng'];
                if (isset($location['url'])) {
                    $map = $location['url'];
                } else {
                    $map = 'https://maps.google.com/?q=' . $location['lat'] . ',' . $location['lng'];
                }
            } else {
                $map = $old_data->map ?? '';
            }

            BusinessDirectory::where('id', $id)->update([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'status' => $request->status,
                'address' => $request->address,
                'description' => $request->description,
                'business_profile_link' => $request->business_profile_link,
                'map' => $map,
                'lat' => $lat ?? $old_data->lat,
                'lang' => $lang ?? $old_data->lang,
                'thumbnail' => $image_url,
                'updated_at' => Carbon::now(),
            ]);
        } catch (\Throwable $th) {

            DB::rollback();
            $data['stuats'] = 'failed';
            $data['message'] = $th->getMessage();
            return $data;
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Business update successfully!';
        Session::forget('location');

        return redirect()->route('business-directory.index')->with($data['status'], $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $businessdirectories = DB::table('ads_business_directory')->where('id', $id)->first();

        if (file_exists($businessdirectories->thumbnail)) {
            unlink($businessdirectories->thumbnail);
        }

        DB::table('ads_business_directory')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Business directory successfully delete!');
    }

    public function businessDirectoryContact()
    {
        $contactauthor = DB::table('contact_author')->latest()->paginate(10);
        return view('admin.businessdirectory.contact', compact('contactauthor'));
    }

    public function businessDirectoryContactDelete($id)
    {
        DB::table('contact_author')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Business author contact successfully delete!');
    }

    public function businessClaim()
    {
        $businessclaim = BusinessClaim::latest()->paginate(10);

        return view('admin.businessdirectory.businessclaim', compact('businessclaim'));
    }

    public function businessClaimDelete($id)
    {
        DB::table('business_claim')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Business claim successfully delete!');
    }

    public function businessClaimUpdateStatus(Request $request)
    {

        $setting = setting();
        $password = rand(0, 99999999);

        $businessclaim = DB::table('business_claim')->where('id', $request->business_claim_id)->first();


        $checkuseremail = DB::table('users')->where('email', $businessclaim->email)->first();

        if ($checkuseremail) {

            DB::table('ads_business_directory')->where('id', $businessclaim->ad_id)->update([
                'user_id' => $checkuseremail->id,
            ]);

            DB::table('business_claim')->where('id', $request->business_claim_id)->update([
                'status' => 1,
            ]);

            $details = [
                'name' => $businessclaim->name,
                'mailform' => 'Super Admin',
                'title' => 'Business claim information',
                'message' => 'Your business claim successfully done by admin. Now, you can access your business directory form your account',
                'action_button' => route('users.login'),
            ];

            Mail::to($businessclaim->email)->send(new \App\Mail\BusinessApproved($details));
        } else {

            $crateUser = DB::table('users')->insertGetId([
                'name' => $businessclaim->name,
                'email' => $businessclaim->email,
                'username' => str_replace(' ', '', $businessclaim->name),
                'password' =>  bcrypt($password),
            ]);

            DB::table('user_plans')->insert([
                'user_id' => $crateUser,
                'ad_limit'  =>  $setting->free_ad_limit,
                'featured_limit'  =>  $setting->free_featured_ad_limit,
                'business_directory_limit'  =>  $setting->free_business_directory_limit,
                'subscription_type' => $setting->subscription_type,
                'created_at' => Carbon::now(),
            ]);

            DB::table('ads_business_directory')->where('id', $businessclaim->ad_id)->update([
                'user_id' => $crateUser,
            ]);

            DB::table('business_claim')->where('id', $request->business_claim_id)->update([
                'status' => 1,
            ]);

            $details = [
                'name' => $businessclaim->name,
                'mailform' => 'Super Admin',
                'title' => 'Business claim information',
                'message' => 'Your business is approved by admin. Now, you can access your business directory form your account',
                'email' => $businessclaim->email,
                'password' => $password,
                'action_button' => route('users.login'),
            ];

            Mail::to($businessclaim->email)->send(new \App\Mail\BusinessApprovedMailPassword($details));
        }

        return redirect()->back()->with('success', 'Approved successfully done.');
    }

    function getElementsByClassName($dom, $ClassName, $tagName = null, $parentNode = null)
    {
        if ($parentNode) {
            $id = $dom->getElementById($parentNode);
            if ($tagName) {
                $Elements = $id->getElementsByTagName($tagName);
            } else {
                $Elements = $id->getElementsByTagName("*");
            }
        } else {
            if ($tagName) {
                $Elements = $dom->getElementsByTagName($tagName);
            } else {
                $Elements = $dom->getElementsByTagName("*");
            }
        }
        $Matched = '';
        $body = '';
        for ($i = 0; $i < $Elements->length; $i++) {
            if ($Elements->item($i)->attributes->getNamedItem('class')) {
                if ($Elements->item($i)->attributes->getNamedItem('class')->nodeValue == $ClassName) {
                    // $Matched[]=$Elements->item($i);
                    foreach ($Elements->item($i)->childNodes as  $value) {
                        $body .= $dom->saveHTML($value);
                    }
                    $Matched = $body;
                }
            }
        }
        return $Matched;
    }
    function getElementsByClassNameSingle($dom, $ClassName, $tagName = null, $parentNode = null)
    {
        if ($parentNode) {
            $id = $dom->getElementById($parentNode);
            if ($tagName) {
                $Elements = $id->getElementsByTagName($tagName);
            } else {
                $Elements = $id->getElementsByTagName("*");
            }
        } else {
            if ($tagName) {
                $Elements = $dom->getElementsByTagName($tagName);
            } else {
                $Elements = $dom->getElementsByTagName("*");
            }
        }
        $Matched = [];
        $body = '';
        for ($i = 0; $i < $Elements->length; $i++) {
            if ($Elements->item($i)->attributes->getNamedItem('class')) {
                if ($Elements->item($i)->attributes->getNamedItem('class')->nodeValue == $ClassName) {
                    // $Matched[]=$Elements->item($i);
                    foreach ($Elements->item($i)->childNodes as  $value) {
                        $body = $dom->saveHTML($value);
                        $Matched[] = $body;
                    }
                }
            }
        }
        return $Matched[0];
    }

    function getElementsByTags($dom, $tagName = null, $parentNode = null)
    {
        if ($parentNode) {
            $id = $dom->getElementById($parentNode);
            if ($tagName) {
                $Elements = $id->getElementsByTagName($tagName);
            } else {
                $Elements = $id->getElementsByTagName("*");
            }
        } else {
            if ($tagName) {
                $Elements = $dom->getElementsByTagName($tagName);
            } else {
                $Elements = $dom->getElementsByTagName("*");
            }
        }
        $Matched = '';
        $body = '';
        for ($i = 0; $i < $Elements->length; $i++) {
            foreach ($Elements->item($i)->childNodes as  $value) {
                $body .= $dom->saveHTML($value);
            }
            $Matched = $body;
        }
        return $Matched;
    }

    public function fileImport(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        // dd($request->all());
        try {
            Excel::import(new BusinessDirectoryImport, $request->file('file')->store('temp'));
            return redirect()->back()->with('success', 'Data Imported Successfully');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}
