<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Organizer;
use Illuminate\Support\Facades\Session as FacadesSession;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizers = Organizer::where('active', 1)->get();
        return view ('organizers.index', ['organizers'=> $organizers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("organizers.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $organizer = $request->validate([
           'name' => 'required|max:60',
            'description' => 'required|max:255',
            'facebook_link' => 'required|url',
            'x_link' =>'required|url',
            'website_link' => 'required|url',
            
        ]);

        if (!$organizer) {
            FacadesSession::flash('message', 'Organizer gagal di tambahkan !');
            FacadesSession::flash('alert-class', 'failed');
            return redirect()->route('organizers.index');
        }
        Organizer::create([
            'name' => $request->name,
            'description' => $request->description,
            'facebook_link' => $request->facebook_link,
            'x_link' => $request -> x_link,
            'website_link' => $request -> website_link,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Organizer berhasil di tambahkan !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('organizers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $organizer = Organizer::query()->where('id', $id)->firstOrFail();
        return view("organizers.show", [
            'organizer' => $organizer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organizer = Organizer::query()->where('id', $id)->first();
        return view("organizers.form", ['organizer' => $organizer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $organizer = $request->validate([
           'name' => 'required|max:60',
            'description' => 'required|max:255',
            'facebook_link' => 'required|url',
            'x_link' =>'required|url',
            'website_link' => 'required|url',
        ]);

        if (!$organizer) {
            FacadesSession::flash('message', 'organizers gagal di tambahkan !');
            FacadesSession::flash('alert-class', 'failed');
            return redirect()->route('organizers.index');
        }

        Organizer::query()->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'facebook_link' => $request->facebook_link,
            'x_link' => $request -> x_link,
            'website_link' => $request -> website_link,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Organizer berhasil diupdate !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('organizers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Organizer::query()->where('id', $id)->update([
            'active' => 0,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        FacadesSession::flash('message', 'Organizer berhasil dihapus !');
        FacadesSession::flash('alert-class', 'success');
        return redirect()->route('organizers.index');
    }
}
