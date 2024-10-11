<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organizer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'facebook_link', 'x_link', 'website_link'];
    public function events():HasMany{
        return $this->hasMany(Event::class);
    }
}
