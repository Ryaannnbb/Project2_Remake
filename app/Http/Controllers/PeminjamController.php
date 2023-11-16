<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PeminjamController extends Controller
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
        $request->validate([
            'nama_peminjam' => [
                'required',
                'regex:/^[A-Za-z\s]+$/',
                Rule::unique('tb_peminjam', 'nama_peminjam')->ignore($request->id),
            ],
            'alamat' => 'required|string|max:255',
            'no_telepon' => [
                'required',
                'string',
                'max:20',
                Rule::unique('tb_peminjam', 'no_telepon')->ignore($request->id),
                'regex:/^\+62 \d{3}-\d{4}-\d{4}$/',
            ],
        ], [
            'nama_peminjam.required' => 'The Borrower Name field is required.',
            'nama_peminjam.regex' => 'The Borrower Name field should contain only letters and spaces.',
            'nama_peminjam.unique' => 'The Borrower Name is already in use.',
            'alamat.required' => 'The Address field is required.',
            'alamat.max' => 'The Address field should not exceed 255 characters.',
            'no_telepon.required' => 'The Phone Number field is required.',
            'no_telepon.max' => 'The Phone Number should not exceed 20 characters.',
            'no_telepon.unique' => 'The Phone Number is already in use.',
            'no_telepon.regex' => 'The phone number format is invalid. It should be in the format: +62 xxx-xxxx-xxxx',
        ]);

        Peminjam::create($request->all());

        return redirect()->route('peminjam')->with("success", "Borrower data has been successfully added.");
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

        // Memeriksa apakah data yang akan diubah sama dengan data sebelumnya
        if (
            $request->nama_peminjam == $peminjam->nama_peminjam &&
            $request->alamat == $peminjam->alamat &&
            $request->no_telepon == $peminjam->no_telepon
        ) {
            return redirect()->back()->with("error", "The data you're trying to edit is the same as before.");
        }

        // Validasi lainnya
        $request->validate([
            'nama_peminjam' => [
                'required',
                'regex:/^[A-Za-z\s]+$/',
                Rule::unique('tb_peminjam', 'nama_peminjam')->ignore($request->id),
            ],
            'alamat' => 'required|string|max:255',
            'no_telepon' => [
                'required',
                'string',
                'max:20',
                Rule::unique('tb_peminjam', 'no_telepon')->ignore($request->id),
                'regex:/^\+62 \d{3}-\d{4}-\d{4}$/',
            ],
        ], [
            'nama_peminjam.required' => 'The Borrower Name field is required.',
            'nama_peminjam.regex' => 'The Borrower Name field should contain only letters and spaces.',
            'nama_peminjam.unique' => 'The Borrower Name is already in use.',
            'alamat.required' => 'The Address field is required.',
            'alamat.max' => 'The Address field should not exceed 255 characters.',
            'no_telepon.required' => 'The Phone Number field is required.',
            'no_telepon.max' => 'The Phone Number should not exceed 20 characters.',
            'no_telepon.unique' => 'The Phone Number is already in use.',
            'no_telepon.regex' => 'The phone number format is invalid. It should be in the format: +62 xxx-xxxx-xxxx',
        ]);

        $peminjam->update($request->all());
        return redirect()->route('peminjam')->with("success","Borrower data has been successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $peminjam= Peminjam::find($id);
            $peminjam->delete();
            return redirect()->route("peminjam")->with("success","Borrower data has been successfully deleted.");
        }

        catch (Exception $e) {
            return back()->with("warning", "Failed because it is currently in use");
        }

    }
}
