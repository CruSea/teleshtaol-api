<?php

use Illuminate\Database\Seeder;
use App\Testimony;

class TestimoniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Testimony::class, 30)->create();     
    }
}
