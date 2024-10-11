<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Session as FacadesSession;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('active', 1)->orderBy('date', 'desc')->get();
        return view('events.index', ['events' => $events]);
    }

    public function search(Request $request)
    {

        $events =  Event::where('active', 1)->orderBy('date', 'desc')->get();

        if ($request->keyword != '') {
            $events = Event::with('organizer')->where('active', 1) // Ensure active = 1
            ->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->keyword . '%')
                      ->orWhere('venue', 'LIKE', '%' . $request->keyword . '%')
                      ->orWhereHas('organizer', function ($subQuery) use ($request) {
                          $subQuery->where('name', 'LIKE', '%' . $request->keyword . '%');
                      });
            })
            ->orderBy('date', 'desc')
            ->get();
        }



        return response()->json(['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event_categories = EventCategory::query()->get();
        $organizers = Organizer::query()->get();
        return view("events.form", ['event_categories' => $event_categories, 'organizers' => $organizers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = $request->validate([
            'title' => 'required|max:255',
            'venue' => 'required|max:255',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'description' => 'required',
            'booking_url' => 'url|nullable',
            'tags' => 'required',
            'organizer_id' => 'required|exists:organizers,id',
            'event_category_id' => 'required|exists:event_categories,id',
        ]);

        if (!$event) {
            FacadesSession::flash('message', 'Artikel gagal di tambahkan !');
            FacadesSession::flash('alert-class', 'failed');
            return redirect()->route('articles.index');
        }
        Event::create([
            'title' => $request->title,
            'venue' => $request->venue,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'description' => $request->description,
            'booking_url' => $request->booking_url ? $request->booking_url : null,
            'tags' => $request->tags,
            'organizer_id' => $request->organizer_id,
            'event_category_id' => $request->event_category_id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Event berhasil di tambahkan !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::query()->where('id', $id)->firstOrFail();
        return view("events.show", [
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::query()->where('id', $id)->first();
        $event_categories = EventCategory::query()->get();
        $organizers = Organizer::query()->get();
        return view("events.form", ['event' => $event, 'event_categories' => $event_categories, 'organizers' => $organizers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = $request->validate([
            'title' => 'required|max:255',
            'venue' => 'required|max:255',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'description' => 'required',
            'booking_url' => 'url|nullable',
            'tags' => 'required',
            'organizer_id' => 'required|exists:organizers,id',
            'event_category_id' => 'required|exists:event_categories,id',
        ]);

        if (!$event) {
            FacadesSession::flash('message', 'Event gagal di tambahkan !');
            FacadesSession::flash('alert-class', 'failed');
            return redirect()->route('events.index');
        }

        Event::query()->where('id', $id)->update([
            'title' => $request->title,
            'venue' => $request->venue,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'description' => $request->description,
            'booking_url' => $request->booking_url ? $request->booking_url : null,
            'tags' => $request->tags,
            'organizer_id' => $request->organizer_id,
            'event_category_id' => $request->event_category_id,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Event berhasil diupdate !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::query()->where('id', $id)->update([
            'active' => 0,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Event berhasil dihapus !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('events.index');
    }
}
