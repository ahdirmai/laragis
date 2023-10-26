<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\DestinationDetail;
use App\Models\Province;
use Flasher\Prime\FlasherInterface;
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
            $destination->slug = $destination_raw->slug;
            $destination->address = $destination_raw->address;
            $destination->category = $destination_raw->category->name;
            $destination->image = $destination_raw->getFirstMediaUrl('destination/', 'preview') ? $destination_raw->getFirstMediaUrl('destination/', 'preview') : "https://source.unsplash.com/random/";
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

    public function store(StoreDestinationRequest $request, FlasherInterface $flasher)
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
        $destination_created = $destination->save();

        // store image to Spatie Media Library
        if ($destination_created) {
            if ($request->hasFile('imageInput')) {
                $destination->addMediaFromRequest('imageInput')->toMediaCollection('destination/');
            }
            sweetalert()->addSuccess('Destination Created Successfully');
        }
        return redirect()->route('admin.destinations.index');
    }

    public function show($destination)
    {
        // return $destination;
        $destination = Destination::where('slug', $destination)->first();
        // $destination->open = json_encode($destination->destinationDetails->detail);


        // return $destination->getMedia("*");
        $destination->image = $destination->getMedia('*');
        // return $destination->image->first()->getUrl();
        $data = [
            'destination' => $destination,
        ];

        // return $destination->destinationDetails->detail['monday']['open'];

        // return $destination;
        return view('admin.pages.destination.show', $data);
    }

    public function storeGallery(Request $request, $slug, FlasherInterface $flasher)
    {

        $destination = Destination::where('slug', $slug)->first();

        $destination_id = $destination->id;
        $request->validate([
            'attachment.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk gambar
        ]);

        // return $request->attachment;
        if ($request->hasFile('attachment')) {
            $images = $request->file('attachment');

            // $images_array = [];
            $fileAdders = $destination->addMultipleMediaFromRequest(['attachment'])
                ->each(function ($fileAdder) use ($destination_id) {
                    $fileAdder->toMediaCollection('destination/');
                });
            if ($fileAdders) {
                sweetalert()->addSuccess('Galery Updated Successfully');
                return redirect()->back();
            }
        }
        sweetalert()->addDanger('Failed to Update Gallery');
        return redirect()->back();

        // return
    }

    public function editOpenHours($slug)
    {
        $destination = Destination::where('slug', $slug)->first();
        $destinationDetails = $destination->destinationDetails;
        $target = 'admin.pages.destination.create-destination-details';
        if (!$destinationDetails) {
            $url = route('admin.destinations.open-hours.store', $slug);
            $destinationDetails = null;
            $condition = 'create';
        } else {
            $url = route('admin.destinations.open-hours.update', $slug);
            $condition = 'edit';
        }

        // return $destinationDetails->detail['monday']['close'];

        $data = [
            'url' => $url,
            'destinationDetails' => $destinationDetails,
            'condition' => $condition,
        ];
        return view($target, $data);
    }

    public function storeOpenHours(Request $request, $slug)
    {
        // return $request;
        $destination = Destination::where('slug', $slug)->first();

        $destinationDetails = $destination->destinationDetails;
        if (!$destinationDetails) {
            $destinationDetails = new DestinationDetail();
            $destinationDetails->destination_id = $destination->id;
        }
        $destinationDetails->open_day_type = $request->open_day_type;
        $destinationDetails->open_time_type = $request->open_time_type;
        if ($request->open_time_type == 'default') {
            $time = ['open' => '08:00', 'close' => '17:00'];
        } else {
            $time = ['open' => $request->timeOpen, 'close' => $request->timeClose];
        }

        $details = [];
        if ($request->open_day_type == 'everyday') {
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        } else {
            $days = $request->checkbox;
        }

        foreach ($days as $index => $day_raw) {
            if ($request->open_time_type == 'default') {
                $day = [
                    $day_raw => [
                        'open' => $time['open'],
                        'close' => $time['close']
                    ]
                ];
            } else {
                $day = [
                    $day_raw => [
                        'open' => $time['open'][$index],
                        'close' => $time['close'][$index]
                    ]
                ];
            }

            array_push($details, $day);
        }
        $combinedData = [];

        foreach ($details as $item) {
            $day = key($item);
            $combinedData[$day] = $item[$day];
        }
        $destinationDetails->detail = $combinedData;
        $destinationDetails->save();

        sweetalert()->addSuccess('Destination Details Update Successfully');
        return redirect()->route('admin.destinations.show', $slug);
    }
}
