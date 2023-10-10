<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cafe',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ],
            [
                'name' => 'Restaurant',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ],
            [
                'name' => 'Hotel',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ],
            [
                'name' => 'Tourism',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusamus facilis alias reprehenderit, quia sint facere iusto totam veritatis velit?'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
