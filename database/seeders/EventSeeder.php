<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $events = [
            ['title'=>'Indonesia Innovation Challenge Powered by Launch Pad', 
            'venue'=>'Jatim Expo',
            'date'=>'2024-10-23',
            'start_time'=>'09:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Surabaya Science & Tech Events, Innovation Challenge',
            'organizer_id'=>rand(1,5),
            'event_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],

            ['title'=>'Kids Education Expo 2024', 
            'venue'=>'The Westin',
            'date'=>'2024-10-21',
            'start_time'=>'09:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Kids Expo, Education Expo',
            'organizer_id'=>rand(1,5),
            'event_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],

            ['title'=>'Surabaya Great Expo 2024', 
            'venue'=>'Grand City Surabaya',
            'date'=>'2024-10-16',
            'start_time'=>'08:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Kids Expo, Education Expo',
            'organizer_id'=>rand(1,5),
            'event_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],

            ['title'=>'SMEX (Surabaya Music, Multimedia, and Lighting Expo 2024', 
            'venue'=>'Grand City Surabaya',
            'date'=>'2024-09-29',
            'start_time'=>'08:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Surabaya Expo',
            'organizer_id'=>rand(1,5),
            'event_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],

            ['title'=>'Japan Edu Expo', 
            'venue'=>'Hotel Said',
            'date'=>'2024-09-22',
            'start_time'=>'08:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Surabaya Expo',
            'organizer_id'=>rand(1,5),
            'event_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],

            ['title'=>'Surabaya Hospital Expo 2024', 
            'venue'=>'Grand City Surabaya',
            'date'=>'2024-10-11',
            'start_time'=>'08:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Surabaya Expo',
            'organizer_id'=>rand(1,5),
            'event_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')],

    ];
        foreach($events as $event){
            DB::table('events')->insert([
                'title'=>$event['title'],
                'venue'=>$event['venue'],
                'date'=>$event['date'],
                'start_time'=>$event['start_time'],
                'description'=>$event['description'],
                'booking_url'=>$event['booking_url'],
                'tags'=>$event['tags'],
                'organizer_id'=>$event['organizer_id'],
                'event_category_id'=>$event['event_category_id'],
                'created_at'=>$event['created_at'],
                'updated_at'=>$event['updated_at'],
            ]);
        }
        
    }
}
