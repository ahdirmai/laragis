<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        return view('admin.pages.facility.index');
    }

    public function create()
    {
        $data = [
            'url' => route('admin.facilities.store')
        ];
        return view('admin.pages.facility.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        $store = Facility::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description
        ]);

        if ($store) {
            sweetalert()->addSuccess('Facility Created Successfully');
            return redirect()->back();
        } else {
            return redirect()->back();
        }

        // return $request;
    }
}
