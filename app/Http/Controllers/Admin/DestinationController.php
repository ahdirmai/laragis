<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Province;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations_raw = Destination::all();
        $destinations = [];
        foreach ($destinations_raw as $destination_raw) {
            $destination = new \stdClass();
            $destination->id = $destination_raw->id;
            $destination->name = $destination_raw->name;
            $destination->address = $destination_raw->address;
            $destination->category = $destination_raw->category->name;
            $destination->thumbnail = "https://source.unsplash.com/random/300×300";
            $destination->status = true;
            array_push($destinations, $destination);
        }

        // return $destinations->destination;
        $data = [
            'destinations' => $destinations,
        ];

        return view('admin.pages.destination.index', $data);
    }

    public function create()
    {
        $categories = Category::all();
        $province = Province::all();
        $data = [
            'categories' => $categories,
            'provinces' => $province,
        ];
        return view('admin.pages.destination.create', $data);
    }
}
