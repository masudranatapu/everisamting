<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class EventVenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventvenues = DB::table('event_venues')->latest()->paginate(10);
        return view('admin.event.eventvenues.index', compact('eventvenues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = DB::table('country')->get();
        return view('admin.event.eventvenues.create', compact('countries'));
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
            'name' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'status' => 'required',
            'country' => 'required',
        ]);

        DB::table('event_venues')->insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'website' => $request->website,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Event venues successfully crate!');

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
        $countries = DB::table('country')->get();
        $eventvenues = DB::table('event_venues')->where('id', $id)->first();

        return view('admin.event.eventvenues.edit', compact('countries', 'eventvenues'));
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
            'name' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'status' => 'required',
            'country' => 'required',
        ]);

        DB::table('event_venues')->where('id', $id)->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'website' => $request->website,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('event-venues.index')->with('success', 'Event venues successfully updated!');

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
        DB::table('event_venues')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Event venues successfully delete!');
    }
}
