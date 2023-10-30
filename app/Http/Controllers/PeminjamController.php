<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjam = Peminjam::all();
        return view("peminjam.index", compact("peminjam"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("peminjam.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Peminjam::create($request->all());
        return redirect()->route('peminjam')->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjam = Peminjam::find($id);
        return view('peminjam.edit', compact('peminjam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peminjam = Peminjam::find($id);
        $peminjam->updated($request->all());
        return redirect()->route('peminjam')->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjam= Peminjam::find($id);
        $peminjam->delete();
        return redirect()->route("peminjam")->with("success","");
    }
}
