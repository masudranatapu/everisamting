<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;

class EventOrganiserController extends Controller
{ 
    public function index()
    {
        $eventorganiser = DB::table('event_organiser')->latest()->paginate(10);
        return view('admin.event.eventorganiser.index', compact('eventorganiser'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        DB::table('event_organiser')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        flashSuccess('Event organiser successfully created.');

        return redirect()->back();
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        DB::table('event_organiser')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);

        flashSuccess('Event organiser successfully updated.');

        return redirect()->back();

    }
    
    public function destroy($id)
    {
        DB::table('event_organiser')->where('id', $id)->delete();

        flashSuccess('Event organiser successfully delete.');
        return redirect()->back()->with('success', 'Event organiser successfully delete!');
    }
    

}