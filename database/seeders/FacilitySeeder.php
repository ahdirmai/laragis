<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Wifi',
                'slug' => 'wifi',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ],
            [
                'name' => 'Toilet',
                'slug' => 'toilet',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ],
            [
                'name' => 'Smoking Area',
                'slug' => 'smoking-area',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ],
            [
                'name' => 'Non Smoking Area',
                'slug' => 'non-smoking-area',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ]
        ];
        foreach ($facilities as $facility) {
            \App\Models\Facility::create($facility);
        }
    }
}
