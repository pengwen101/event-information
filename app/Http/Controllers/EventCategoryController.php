<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Session as FacadesSession;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event_categories = EventCategory::where('active', 1)->get();
        return view ('event_categories.index', ['event_categories'=> $event_categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("event_categories.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $event_categories = $request->validate([
            'name' => 'required|max:255',
            
        ]);

        if (!$event_categories) {
            FacadesSession::flash('message', 'Artikel gagal di tambahkan !');
            FacadesSession::flash('alert-class', 'failed');
            return redirect()->route('event_categories.index');
        }
        EventCategory::create([
            'name' => $request->name,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Event category berhasil di tambahkan !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('event-categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event_categories = EventCategory::query()->where('id', $id)->firstOrFail();
        return view("event_categories.show", [
            'event_categories' => $event_categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event_category = EventCategory::query()->where('id', $id)->first();
        return view("event_categories.form", ['event_category' => $event_category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event_categories = $request->validate([
            'name' => 'required|max:255',
           
        ]);

        if (!$event_categories) {
            FacadesSession::flash('message', 'event_categories gagal di tambahkan !');
            FacadesSession::flash('alert-class', 'failed');
            return redirect()->route('event_categories.index');
        }

        EventCategory::query()->where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Event category berhasil diupdate !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('event-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        EventCategory::query()->where('id', $id)->update([
            'active' => 0,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Event category berhasil dihapus !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('event-categories.index');
    }
}
