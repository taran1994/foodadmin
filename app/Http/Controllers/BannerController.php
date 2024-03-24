<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $banners = Banner::filter(request(['search']))
                ->paginate($row)
                ->appends(request()->query());
           
        return view('banner.index', [
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:banner,name',
            'slug' => 'required|unique:banner,slug|alpha_dash',
            'image' => 'required',
        ];

        $validatedData = $request->validate($rules);
        if ($file = $request->file('image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/banners/';

            /**
             * Upload an image to Storage
             */
            $file->storeAs($path, $fileName);
            $validatedData['image'] = $fileName;
        }
        $validatedData['content'] = $request->content;

        Banner::create($validatedData);

        return Redirect::route('banner.index')->with('success', 'Banner has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('banner.edit', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $rules = [
            'name' => 'required|unique:banner,name,'.$banner->id,
            'slug' => 'required|alpha_dash|unique:banner,slug,'.$banner->id,
        ];

        $validatedData = $request->validate($rules);
        if ($file = $request->file('image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/banners/';

            /**
             * Delete photo if exists.
             */
            if($banner->image){
                Storage::delete($path . $banner->image);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $validatedData['image'] = $fileName;
        }
        $validatedData['content'] = $request->content;

        Banner::where('slug', $banner->slug)->update($validatedData);

        return Redirect::route('banner.index')->with('success', 'Banner has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        Banner::destroy($banner->id);

        return Redirect::route('banner.index')->with('success', 'Banner has been deleted!');
    }

     public function banners()
     {
        $banners =  Banner::get();
        foreach($banners as $banner) {
            $banner['image'] = $banner->image ? asset('storage/banners/'.$banner->image) : asset('assets/img/products/default.webp');
        }
        return response()->json([
            'banners' => $banners
        ]);

     }
}
