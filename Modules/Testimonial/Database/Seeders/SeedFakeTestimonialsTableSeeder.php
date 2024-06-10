<?php

namespace Modules\Testimonial\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Testimonial\Entities\Testimonial;

use Faker\Generator as Faker;

class SeedFakeTestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Model::unguard();

    }
}
