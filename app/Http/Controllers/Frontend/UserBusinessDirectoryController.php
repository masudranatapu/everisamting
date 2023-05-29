<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BusinessDirectory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserBusinessDirectoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userbusinessdirectories = DB::table('ads_business_directory')->where('user_id', auth('user')->user()->id)->latest()->paginate(9);
        return view('frontend.userbusinessdirectory.index', compact('userbusinessdirectories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        //
        $checkuserplan = DB::table('user_plans')->where('user_id', auth('user')->user()->id)->first();

        if ($checkuserplan->business_directory_limit <= 0) {

            $data['status'] = 'error';
            $data['message'] = 'Your business directory out of limit';

            return redirect()->back()->with($data['status'], $data['message']);
        }


        $categories = DB::table('categories')->where('type', 2)->get();
        return view('frontend.userbusinessdirectory.create', compact('categories'));
    }


    public function businessCategorySubcategory($id)
    {
        $subcategory = DB::table('sub_categories')->where('category_id', $id)->get();
        return response()->json($subcategory);
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


        if (Session::has('location')) {
            $location = session()->get('location');
            $lat = $location['lat'];
            $lang = $location['lng'];

            if (isset($location['url'])) {
                $map = $location['url'];
            } else {
                $map = 'https://maps.google.com/?q=' . $location['lat'] . ',' . $location['lng'];
            }
        }

        // else {
        //     flashError('Please Select a location');
        //     return redirect()->back()->withInput();
        // }



        DB::beginTransaction();
        try {
            $businessdirectoryimage = $request->file('thumbnail');
            if ($businessdirectoryimage) {

                $upload_path = 'businessdirectory';
                $image_url = uploadAdImage($businessdirectoryimage, $upload_path, 800, 400);
            }

            BusinessDirectory::create([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'user_id' => auth('user')->user()->id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'status' => 'pending',
                'address' => $request->address,
                'business_profile_link' => $request->business_profile_link,
                'lat' => $lat ?? '',
                'lang' => $lang ?? '',
                'description' => $request->description,
                'map' => $map ?? '',
                'created_at' => Carbon::now(),
                'thumbnail' => $image_url ?? null,
            ]);

            $checkuserplan = DB::table('user_plans')->where('user_id', auth('user')->user()->id)->first();

            DB::table('user_plans')->where('user_id', auth('user')->user()->id)->update([
                'business_directory_limit' => $checkuserplan->business_directory_limit - 1,
            ]);
        } catch (\Throwable $th) {
            // dd(1);
            DB::rollback();
            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
            return $data;
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Business directory created successfully!';
        Session::forget('location');

        return redirect()->route('frontend.user-business-directory.index')->with($data['status'], $data['message']);
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
        $categories = DB::table('categories')->where('type', 2)->get();
        $subcategories = DB::table('sub_categories')->where('type', 2)->get();
        return view('frontend.userbusinessdirectory.edit', compact('businessdirectories', 'categories', 'subcategories'));
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
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);


        DB::beginTransaction();

        try {

            $old_data = DB::table('ads_business_directory')->where('id', $id)->first();
            $businessdirectoryimage = $request->file('thumbnail');
            if ($businessdirectoryimage) {

                $upload_path = 'businessdirectory';
                $image_url = uploadAdImage($businessdirectoryimage, $upload_path, 200, 200);

                if (file_exists($old_data->thumbnail)) {
                    unlink($old_data->thumbnail);
                }
            } else {
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
                'user_id' => auth('user')->user()->id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'phone_2' => $request->phone_2,
                'address' => $request->address,
                'description' => $request->description,
                'business_profile_link' => $request->business_profile_link,
                'lat' => $lat ?? $old_data->lat,
                'lang' => $lang ?? $old_data->lang,
                'map' => $map,
                'created_at' => Carbon::now(),
                'thumbnail' => $image_url,
            ]);
        } catch (\Throwable $th) {

            DB::rollback();
            $data['status'] = 'failed';
            $data['message'] = $th->getMessage();
            flashError();
            return back();
        }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Business update successfully!';
        Session::forget('location');

        return redirect()->route('frontend.user-business-directory.index')->with($data['status'], $data['message']);
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


}
