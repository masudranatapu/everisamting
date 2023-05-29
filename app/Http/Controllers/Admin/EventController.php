<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = DB::table('events')->latest()->paginate(10);
        return view('admin.event.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $eventcategory = DB::table('event_categories')->where('status', 1)->get();
        $eventorganiser = DB::table('event_organiser')->where('status', 1)->get();
        $eventtags = DB::table('event_tags')->where('status', 1)->get();
        $eventvenes = DB::table('event_venues')->where('status', 1)->get();
        $countries = DB::table('country')->get();
        $users = DB::table('users')->latest()->get();
        return view('admin.event.events.create', compact('eventcategory', 'eventorganiser', 'eventtags', 'eventvenes', 'countries', 'users'));
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
            'details' => 'required',
            'short_description' => 'required|max:250',
        ]);

        DB::beginTransaction();
            try {

                if($request->venue_id == "create_new_venue") {
                    if($request->venue_name){
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
                        ]);
                    }

                }else {
                    $venueid = $request->venue_id ?? null;
                }

                $event_image = $request->file('image');
                if($event_image){
                    
                    $upload_path = 'events';
                    $image_url = uploadAdImage($event_image, $upload_path, 940, 400);

                    // $slug = 'events';
                    // $event_image_name = $slug.'-'.uniqid().'.'.$event_image->getClientOriginalExtension();
                    // $upload_path = 'media/events/images/';
                    // $event_image->move($upload_path, $event_image_name);
                    // $image_url = $upload_path.$event_image_name;
                }


                if($request->wheelchair) {
                    $wheelchair = 1;
                }else {
                    $wheelchair = 0;
                }

                if($request->accessible) {
                    $accessible = 1;
                }else {
                    $accessible = 0;
                }

                if($request->all_day_event_status) {
                    $alldayeventstatus = 1;
                    $starttime = NULL;
                    $endttime = NULL;
                }else {
                    $alldayeventstatus = 0;
                    $starttime = $request->start_time;
                    $endttime = $request->end_time;
                }

                $organiser_id_arr = [];

                $organiser_id = $request->organiser_id;
                
                if($organiser_id){
                    asort($organiser_id);
                }
                
                if($organiser_id){
                    foreach ($organiser_id as $key => $value) {
                        if($value == 'create_new_organiser'){
                            if($request->organiser_name){
                                foreach ($request->organiser_name as $key1 => $organiser) {
                                    if($organiser != '' ){
                                        $insert_organiser_id = DB::table('event_organiser')->insertGetId([
                                            'name' => $request->venue_name[$key1] ?? '',
                                            'email' => $request->organiser_email[$key1] ?? '',
                                            'phone' => $request->organiser_phone[$key1] ?? '',
                                            'website' => $request->organiser_website[$key1] ?? '',
                                            'status' => 0,
                                            'created_at' => Carbon::now(),
                                            'created_by' => Auth::user()->id,
                                        ]);
                                        array_push($organiser_id_arr,$insert_organiser_id);
                                    }

                                }
                            }

                            break;

                        }else{
                            array_push($organiser_id_arr,$value);

                        }
                    }
                }


                DB::table('events')->insert([
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'slug' => strtolower(str_replace(' ', '-', $request->title)),
                    'short_description' => $request->short_description,
                    'details' => $request->details,
                    'start_date' => date('Y-m-d',strtotime($request->start_date)),
                    'start_time' => $starttime,
                    'end_time' => $endttime,
                    'end_date' => date('Y-m-d',strtotime($request->end_date)),
                    'timezone' => $request->timezone,
                    'all_day_event_status' => $alldayeventstatus,
                    'image' => $image_url ?? '',
                    'category_id' => json_encode($request->category_id),
                    'tag_id' => json_encode($request->tag_id),
                    'event_status' => $request->event_status,
                    'event_status_reason' => $request->event_status_reason,
                    'status' => $request->status,
                    'venue_id' => $venueid,
                    'organiser_id' => json_encode($organiser_id_arr),
                    'wheelchair' => $wheelchair,
                    'accessible' => $accessible,
                    'event_info_link' => $request->event_info_link,
                    'cost' => $request->cost,
                    'created_at' => Carbon::now(),
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

        return redirect()->back()->with($data['status'], $data['message']);
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
        $eventcategory = DB::table('event_categories')->where('status', 1)->get();
        $eventorganiser = DB::table('event_organiser')->where('status', 1)->get();
        $eventtags = DB::table('event_tags')->where('status', 1)->get();
        $eventvenes = DB::table('event_venues')->where('status', 1)->get();
        $countries = DB::table('country')->get();
        $events = DB::table('events')->where('id', $id)->first();
        // dd($events);
        return view('admin.event.events.show', compact('eventcategory', 'eventorganiser', 'eventtags', 'eventvenes', 'countries', 'events'));
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
        $eventcategory = DB::table('event_categories')->where('status', 1)->get();
        $eventorganiser = DB::table('event_organiser')->where('status', 1)->get();
        $eventtags = DB::table('event_tags')->where('status', 1)->get();
        $eventvenes = DB::table('event_venues')->where('status', 1)->get();
        $countries = DB::table('country')->get();
        $events = DB::table('events')->where('id', $id)->first();
        $users = DB::table('users')->latest()->get();
        return view('admin.event.events.edit', compact('eventcategory', 'eventorganiser', 'eventtags', 'eventvenes', 'countries', 'events', 'users'));

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
            'details' => 'required',
            'short_description' => 'required|max:250',
        ]);

        DB::beginTransaction();
            try {

                if($request->venue_id == "create_new_venue") {
                    if($request->venue_name){
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
                            'created_by' => Auth::user()->id,
                        ]);
                    }

                }else {
                    $venueid = $request->venue_id ?? null;
                }

                $event_image = $request->file('image');

                if($event_image){
                    
                    $upload_path = 'events';
                    $image_url = uploadAdImage($event_image, $upload_path, 940, 400);

                    // $slug = 'events';
                    // $event_image_name = $slug.'-'.uniqid().'.'.$event_image->getClientOriginalExtension();
                    // $upload_path = 'media/events/';
                    // $event_image->move($upload_path, $event_image_name);

                    $old_data = DB::table('events')->where('id', $id)->first();

                    if(file_exists($old_data->image)){
                        unlink($old_data->image);
                    };
                    
                }else {
                    $old_data = DB::table('events')->where('id', $id)->first();
                    $image_url = $old_data->image;
                }

                if($request->wheelchair) {
                    $wheelchair = 1;
                }else {
                    $wheelchair = 0;
                }

                if($request->accessible) {
                    $accessible = 1;
                }else {
                    $accessible = 0;
                }

                if($request->all_day_event_status) {
                    $alldayeventstatus = 1;
                    $starttime = NULL;
                    $endttime = NULL;
                }else {
                    $alldayeventstatus = 0;
                    $starttime = $request->start_time;
                    $endttime = $request->end_time;
                }

                if($request->event_status == 2 || $request->event_status == 3){
                    $eventstatusreason = $request->event_status_reason;
                }else {
                    $eventstatusreason = NULL;
                }

                $organiser_id_arr = [];

                $organiser_id = $request->organiser_id;
                // dd($organiser_id);

                if($organiser_id){
                    asort($organiser_id);
                }
                
                if($organiser_id){
                    foreach ($organiser_id as $key => $value) {
                        if($value == 'create_new_organiser'){
                            if($request->organiser_name){
                                foreach ($request->organiser_name as $key1 => $organiser) {
                                    if($organiser != '' ){
                                        $insert_organiser_id = DB::table('event_organiser')->insertGetId([
                                            'name' => $request->venue_name[$key1] ?? '',
                                            'email' => $request->organiser_email[$key1] ?? '',
                                            'phone' => $request->organiser_phone[$key1] ?? '',
                                            'website' => $request->organiser_website[$key1] ?? '',
                                            'status' => 0,
                                            'created_at' => Carbon::now(),
                                            'created_by' => Auth::user()->id,
                                        ]);
                                        array_push($organiser_id_arr,$insert_organiser_id);
                                    }

                                }
                            }

                            break;

                        }else{

                            array_push($organiser_id_arr,$value);

                        }
                    }
                }

                DB::table('events')->where('id', $id)->update([
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'slug' => strtolower(str_replace(' ', '-', $request->title)),
                    'short_description' => $request->short_description,
                    'details' => $request->details,
                    'start_date' => date('Y-m-d',strtotime($request->start_date)),
                    'start_time' => $starttime,
                    'end_time' => $endttime,
                    'end_date' => date('Y-m-d',strtotime($request->end_date)),
                    'timezone' => $request->timezone,
                    'all_day_event_status' => $alldayeventstatus,
                    'image' => $image_url ?? '',
                    'category_id' => json_encode($request->category_id),
                    'tag_id' => json_encode($request->tag_id),
                    'event_status' => $request->event_status,
                    'event_status_reason' => $eventstatusreason,
                    'status' => $request->status,
                    'venue_id' => $venueid,
                    'organiser_id' => json_encode($organiser_id_arr),
                    'wheelchair' => $wheelchair,
                    'accessible' => $accessible,
                    'event_info_link' => $request->event_info_link,
                    'cost' => $request->cost,
                    'updated_at' => Carbon::now(),
                    'updated_by' => Auth::user()->id,
                ]);

            } catch (\Throwable $th) {
                DB::rollback();
                $data['status'] = 'failed';
                $data['message'] = $th->getMessage();
                return $data;
            }

        DB::commit();

        $data['status'] = 'success';
        $data['message'] = 'Event update successfully!';

        return redirect()->route('events.index')->with($data['status'], $data['message']);

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
        $events = DB::table('events')->where('id', $id)->first();

        if(file_exists($events->image)){
            unlink($events->image);
        }

        flashSuccess('Events successfully delete.');

        DB::table('events')->where('id', $id)->delete();
        
        return redirect()->back()->with('success', 'Event successfully delete!');

    }
}
