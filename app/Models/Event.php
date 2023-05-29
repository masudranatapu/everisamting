<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $appends = ['event_organiser', 'event_tag', 'event_category'];

    public function eventStore($request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            if ($request->venue_id == "create_new_venue") {
                if ($request->venue_name) {
                    $venueid = DB::table('event_venues')->insertGetId([
                        'name' => $request->venue_name,
                        'address' => $request->venue_address ?? '',
                        'city' => $request->venue_city ?? '',
                        'country' => $request->venue_country ?? '',
                        'state' => $request->venue_state ?? '',
                        'postal_code' => $request->venue_postal_code ?? '',
                        'phone' => $request->venue_phone ?? '',
                        'website' => $request->venue_website ?? '',
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'created_by' => auth('user')->user()->id,
                    ]);
                }
            } else {
                $venueid = $request->venue_id ?? null;
            }

            $event_image = $request->file('image');
            if ($event_image) {
                $upload_path = 'events';
                $image_url = uploadAdImage($event_image, $upload_path, 940, 400);
                // $slug = 'events';
                // $event_image_name = $slug.'-'.uniqid().'.'.$event_image->getClientOriginalExtension();
                // $event_image->move($upload_path, $event_image_name);
                // $image_url = $upload_path.$event_image_name;
            }

            if ($request->wheelchair) {
                $wheelchair = 1;
            } else {
                $wheelchair = 0;
            }

            if ($request->accessible) {
                $accessible = 1;
            } else {
                $accessible = 0;
            }

            if ($request->all_day_event_status) {
                $alldayeventstatus = 1;
            } else {
                $alldayeventstatus = 0;
            }

            $organiser_id_arr = [];

            $organiser_id = $request->organiser_id;

            if ($organiser_id) {
                asort($organiser_id);
            }

            if ($organiser_id) {
                foreach ($organiser_id as $key => $value) {
                    if ($value == 'create_new_organiser') {
                        if ($request->organiser_name) {
                            foreach ($request->organiser_name as $key1 => $organiser) {
                                if ($organiser != '') {
                                    $insert_organiser_id = DB::table('event_organiser')->insertGetId([
                                        'name' => $request->venue_name[$key1] ?? '',
                                        'email' => $request->organiser_email[$key1] ?? '',
                                        'phone' => $request->organiser_phone[$key1] ?? '',
                                        'website' => $request->organiser_website[$key1] ?? '',
                                        'status' => 0,
                                        'created_at' => Carbon::now(),
                                        'created_by' => auth('user')->user()->id,
                                    ]);
                                    array_push($organiser_id_arr, $insert_organiser_id);
                                }
                            }
                        }

                        break;
                    } else {
                        array_push($organiser_id_arr, $value);
                    }
                }
            }


            DB::table('events')->insert([
                'user_id' => auth('user')->user()->id,
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'short_description' => $request->short_description,
                'details' => $request->details,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                // 'timezone' => $request->timezone,
                'all_day_event_status' => $alldayeventstatus,
                'image' => $image_url ?? '',
                'category_id' => json_encode($request->category_id),
                'tag_id' => json_encode($request->tag_id),
                'event_status' => $request->event_status,
                'event_status_reason' => $request->event_status_reason,
                'status' => 0,
                'venue_id' => $venueid,
                'organiser_id' => json_encode($organiser_id_arr),
                'wheelchair' => $wheelchair,
                'accessible' => $accessible,
                'event_info_link' => $request->event_info_link,
                'cost' => $request->cost,
                'created_at' => Carbon::now(),
                'created_by' => auth('user')->user()->id,
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
        return $data;
    }





    public function venue(): BelongsTo
    {
        return $this->belongsTo(EventVenue::class, 'venue_id', 'id');
    }

    public function getEventOrganiserAttribute()
    {
        $organiser = json_decode($this->organiser_id);
        $organisers = EventOrganiser::findMany($organiser);
        return $organisers ?? [];
    }
    public function getEventTagAttribute()
    {
        $tags = json_decode($this->tag_id);

        $eventTags = EventTags::findMany($tags);
        return $eventTags ?? [];
    }
    public function getEventCategoryAttribute()
    {
        $categories = json_decode($this->category_id);

        $eventCategories = EventCategories::findMany($categories);
        return $eventCategories ?? [];
    }
}
