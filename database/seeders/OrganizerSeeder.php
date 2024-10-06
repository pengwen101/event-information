<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(Faker $faker): void
    {
        $names = ['Southern Sydney University', 'MSW Global', 'Debindo', 'Grand City Surabaya', 'Hotel Said'];
        foreach($names as $name){
            DB::table('organizers')->insert([
                'name'=>$name,
                'description' => $faker->text(),
                'facebook_link'=> $faker->url(),
                'x_link'=> $faker->url(),
                'website_link'=> $faker->url(),
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
