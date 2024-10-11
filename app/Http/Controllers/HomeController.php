<?php

namespace App\Http\Controllers;

use App\Models\Event;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
        public function index(){
            $events = Event::where('active', 1)->orderBy('date', 'desc')->get();
            return view ('index', ['events'=> $events]);
        }
}
