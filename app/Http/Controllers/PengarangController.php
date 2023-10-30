<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengarang;

class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengarang = Pengarang::all();
        return view("pengarang.index", compact("pengarang"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pengarang.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pengarang::create($request->all());
        return redirect()->route('pengarang')->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengarang = Pengarang::find($id);
        return view('pengarang.edit', compact('pengarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengarang = Pengarang::find($id);
        $pengarang->updated($request->all());
        return redirect()->route('pengarang')->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengarang= Pengarang::find($id);
        $pengarang->delete();
        return redirect()->route("pengarang")->with("success","");
    }
}
