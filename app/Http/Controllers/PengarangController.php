<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PengarangController extends Controller
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
        $request->validate([
            'nama_pengarang' => [
                'required',
                'unique:tb_pengarang,nama_pengarang',
                'regex:/^[A-Za-z\s.]+$/'
            ],
            'tahun_kelahiran' => 'required|numeric|min:1900|max:2023',
        ], [
            'nama_pengarang.required' => 'The author\'s name is required.',
            'nama_pengarang.unique' => 'The author already exists.',
            'nama_pengarang.regex' => 'The author\'s name should contain only letters and spaces.',
            'tahun_kelahiran.required' => 'The year of birth is required.',
            'tahun_kelahiran.numeric' => 'The year of birth must be a number.',
            'tahun_kelahiran.min' => 'The minimum year of birth is 1900.',
            'tahun_kelahiran.max' => 'The maximum year of birth is 2023.',
        ]);

        Pengarang::create($request->all());
        return redirect()->route('pengarang')->with("success", "Author data has been successfully added.");
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
    // Menemukan pengarang yang ingin diedit
    $pengarang = Pengarang::find($id);

    // Validasi
    $request->validate([
        'nama_pengarang' => [
            'required',
            'regex:/^[A-Za-z\s.]+$/',
            Rule::unique('tb_pengarang', 'nama_pengarang')->ignore($pengarang->id),
        ],
        'tahun_kelahiran' => 'required|numeric|min:1900|max:2023',
    ], [
        'nama_pengarang.required' => 'The author\'s name is required.',
        'nama_pengarang.regex' => 'The author\'s name should contain only letters, spaces, and periods.',
        'nama_pengarang.unique' => 'The author\'s name is already in use.',
        'tahun_kelahiran.required' => 'The year of birth is required.',
        'tahun_kelahiran.numeric' => 'The year of birth must be a number.',
        'tahun_kelahiran.min' => 'The minimum year of birth is 1900.',
        'tahun_kelahiran.max' => 'The maximum year of birth is 2023.',
    ]);

    // Cek apakah data yang akan diedit sama dengan data yang ada
    if ($request->nama_pengarang == $pengarang->nama_pengarang && $request->tahun_kelahiran == $pengarang->tahun_kelahiran) {
        return redirect()->back()->with("error", "Data you're trying to edit is the same as before.");
    }

    // Jika data yang diubah berbeda, proses pembaruan
    $pengarang->update($request->all());

    return redirect()->route('pengarang')->with("success", "Author data has been successfully updated.");
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $pengarang= Pengarang::find($id);
            $pengarang->delete();
            return redirect()->route("pengarang")->with("success","Author data has been successfully deleted.");
            }

        catch (Exception $e) {
            return back()->with("warning", "Failed because it is currently in use");
        }
    }
}
