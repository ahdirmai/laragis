<?php

namespace Database\Seeders;

use App\Models\DestinationDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Taman Satwa Kebun Binatang Jahri Saleh',
                'slug' => 'taman-satwa-kebun-binatang-jahri-saleh',
                'address' => 'MJR3+M9G, Sungai Jingah, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70122',
                'rating' => 4.5,
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem deserunt maxime perferendis saepe tempora iusto excepturi architecto ea repellendus rem.',
                'latitude' => -3.3084032,
                'longitude' => 114.6033753,
                'village_code' => 6371041004,
                'category_id' => 4,
            ],
            [
                'name' => 'Museum WASAKA',
                'slug' => 'museum-wasaka',
                'address' => 'MJW5+CJG, Jl. Kampung Kenanga, Sungai Jingah, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70122',
                'rating' => 4.5,
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem deserunt maxime perferendis saepe tempora iusto excepturi architecto ea repellendus rem.',
                'latitude' => -3.3039274,
                'longitude' => 114.60908,
                'village_code' => 6371041004,
                'category_id' => 4,
            ],
            [
                'name' => 'Trans Studio Mini Banjarmasin',
                'slug' => 'trans-studio-mini-banjarmasin',
                'address' => 'MJG3+C2H, Melayu, Kec. Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan 70122',
                'rating' => 4.5,
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem deserunt maxime perferendis saepe tempora iusto excepturi architecto ea repellendus rem.',
                'latitude' => -3.3234838,
                'longitude' => 114.6031087,
                'village_code' => 6371051009,
                'category_id' => 4,
            ]
        ];

        foreach ($destinations as $destination) {
            $created = \App\Models\Destination::create($destination);

            $detail = json_encode([
                'monday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
                'tuesday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
                'wednesday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
                'thursday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
                'friday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
                'saturday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
                'sunday' => [
                    'open' => '08:00',
                    'close' => '17:00'
                ],
            ]);

            $data =
                [
                    'destination_id' => $created->id,
                    'open_day_type' => 'everyday',
                    'open_time_type' => 'default',
                    'detail' => $detail
                ];
            DestinationDetail::insert($data);
        }
    }
}
