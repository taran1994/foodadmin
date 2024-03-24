<?php

namespace App\Http\Controllers;

use App\Models\Siteconfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SiteconfigController extends Controller
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

        $config = Siteconfig::filter(request(['search']))
                ->paginate($row)
                ->appends(request()->query());
           
        return view('config.index', [
            'config' => $config,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siteconfig $config)
    {
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siteconfig $config)
    {
        return view('config.edit', [
            'config' => $config
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siteconfig $config)
    {
        $rules = [
            'name' => 'required|unique:site_config,name,'.$config->id,
            'slug' => 'required|alpha_dash|unique:site_config,slug,'.$config->id,
            'slug' => 'required|alpha_dash|unique:site_config,slug,'.$config->id,
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'hours' => 'required',
            'copyright' => 'required',
        ];

        $validatedData = $request->validate($rules);
        if ($file = $request->file('logo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/logo/';

            /**
             * Delete photo if exists.
             */
            if($config->logo){
                Storage::delete($path . $config->logo);
            }

            /**
             * Store an image to Storage
             */
            $file->storeAs($path, $fileName);
            $validatedData['logo'] = $fileName;
        }

        Siteconfig::where('slug', $config->slug)->update($validatedData);

        return Redirect::route('config.index')->with('success', 'Site Details has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siteconfig $config)
    {
       abort(404);
    }

     public function siteconfig()
     {
        $config =  Siteconfig::first();
            $config['logo'] = $config->logo ? asset('storage/logo/'.$config->logo) : asset('assets/img/products/default.webp');
        
        return response()->json([
            'config' => $config
        ]);

     }
}
