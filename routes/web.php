<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::post('/search', [EventController::class, 'search'])->name('events.search');

Route::resource('events', EventController::class);
Route::resource('event-categories', EventCategoryController::class);
Route::resource('organizers', OrganizerController::class);
