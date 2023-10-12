<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
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
            $destination->image = $destination_raw->getFirstMediaUrl('destination/' . $destination_raw->id, 'preview') ? $destination_raw->getFirstMediaUrl('destination/' . $destination_raw->id, 'preview') : "https://source.unsplash.com/random/";
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

    public function store(StoreDestinationRequest $request)
    {
        $destination = new Destination();
        $destination->name = $request->name;
        $destination->slug = \Str::slug($request->name);
        $destination->address = $request->address;
        $destination->description = $request->description;
        $destination->latitude = $request->latitude;
        $destination->longitude = $request->longitude;
        $destination->village_code = $request->village_code;
        $destination->category_id = $request->category;
        $destination->save();

        // store image to Spatie Media Library
        if ($request->hasFile('imageInput')) {
            $destination->addMediaFromRequest('imageInput')->toMediaCollection('destination/' . $destination->id);
        }
        return redirect()->route('admin.destinations.index');
    }
}
