<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
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

        $qrs = Qr::filter(request(['search']))
                ->paginate($row)
                ->appends(request()->query());
        $serverAddr = $_SERVER['HTTP_HOST'];
        foreach($qrs as $qr) {
            $qr['simple'] = QrCode::size(120)->generate($serverAddr.'/'.$qr->name);
        }        
        return view('qr.index', [
            'qrs' => $qrs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('qr.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:qr,name',
            'slug' => 'required|unique:qr,slug|alpha_dash',
        ];

        $validatedData = $request->validate($rules);

        Qr::create($validatedData);

        return Redirect::route('qr.index')->with('success', 'Qr has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Qr $qr)
    {
      abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qr $qr)
    {
        return view('qr.edit', [
            'qr' => $qr
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qr $qr)
    {
        $rules = [
            'name' => 'required|unique:qr,name,'.$qr->id,
            'slug' => 'required|alpha_dash|unique:qr,slug,'.$qr->id,
        ];

        $validatedData = $request->validate($rules);

        Qr::where('slug', $qr->slug)->update($validatedData);

        return Redirect::route('qr.index')->with('success', 'Qr has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qr $qr)
    {
        Qr::destroy($qr->id);

        return Redirect::route('qr.index')->with('success', 'Qr has been deleted!');
    }
}
