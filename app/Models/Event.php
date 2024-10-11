<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'venue', 'date', 'start_time', 'organizer_id', 'event_category_id', 'description', 'tags'];
    protected $casts = [
        'date' => 'date',  
        'start_time' => 'datetime:H:i',
        'organizer_id' =>'integer',
        'event_category_id' =>'integer',

    ];

    public function eventCategory():BelongsTo{
        return $this->belongsTo(EventCategory::class);
    }

    public function organizer():BelongsTo{
        return $this->belongsTo(Organizer::class);
    }
}
