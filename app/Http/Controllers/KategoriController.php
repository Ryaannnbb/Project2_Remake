<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user() == null)
        {
            return view("auth.login");
        }
        $kategori = Kategori::all();
        return view("kategori.index", compact("kategori"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("kategori.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => [
                'required',
                'unique:tb_kategori,nama_kategori',
                'regex:/^[A-Za-z\s]+$/',
            ],
            'deskripsi_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'The category name is required.',
            'nama_kategori.unique' => 'The category name is already in use. Please enter a different category name.',
            'nama_kategori.regex' => 'The category name should contain only letters and spaces.',
            'deskripsi_kategori.required' => 'The category description is required.',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori')->with("success","Category data has been successfully added.");
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
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::find($id);

        // Cek apakah data yang akan diedit sama dengan data yang ada
        if (
            $request->nama_kategori == $kategori->nama_kategori &&
            $request->deskripsi_kategori == $kategori->deskripsi_kategori
        ) {
            return redirect()->back()->with("error", html_entity_decode("The data you're trying to edit is the same as before."));
        }

        $request->validate([
            'nama_kategori' => [
                'required',
                'regex:/^[A-Za-z\s]+$/',
                Rule::unique('tb_kategori', 'nama_kategori')->ignore($kategori->id),
            ],
            'deskripsi_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'The category name is required.',
            'nama_kategori.unique' => 'The category name is already in use. Please enter a different category name.',
            'nama_kategori.regex' => 'The category name should contain only letters and spaces.',
            'deskripsi_kategori.required' => 'The category description is required.',
        ]);

        // Jika data yang akan diedit berbeda, proses pembaruan
        $kategori->update($request->all());

        return redirect()->route('kategori')->with("success", "Category data has been successfully updated.");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $kategori= Kategori::find($id);
            $kategori->delete();
            return redirect()->route("kategori")->with("success","Category data has been successfully deleted.");
        }

        catch (Exception $e) {
            return back()->with("warning", "Failed because it is currently in use");
        }
    }
}
