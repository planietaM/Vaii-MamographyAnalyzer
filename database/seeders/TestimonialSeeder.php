<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::create([
            'name' => 'MUDr. Ivana Lucka',
            'role' => 'Primárka rádiológie, Trnava',
            'text' => 'Mamografický analyzer mi pomohol rýchlo nájsť suspektné ložiská a zlepšil workflow.',
            'image' => '/images/profile1.png',
            'position' => 1,
            'active' => true,
        ]);
    }
}

