<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjam;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
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
        $transaksi = Transaksi::all();
        return view("transaksi.index", compact("transaksi"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book = Book::all();
        $peminjam = Peminjam::all();
        return view("transaksi.create", compact("book", "peminjam"));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'id_buku' => 'required|exists:tb_buku,id',
            'id_peminjam' => 'required|exists:tb_peminjam,id',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        ], [
            'id_buku.required' => 'The Title Book field is required.',
            'id_buku.exists' => 'The selected Title Book does not exist.',
            'id_peminjam.required' => 'The Borrower Name field is required.',
            'id_peminjam.exists' => 'The selected Borrower Name does not exist.',
            'tanggal_peminjaman.required' => 'The Borrowing Date field is required.',
            'tanggal_peminjaman.date' => 'The Borrowing Date should be a valid date.',
            'tanggal_pengembalian.required' => 'The Return Date field is required.',
            'tanggal_pengembalian.date' => 'The Return Date should be a valid date.',
            'tanggal_pengembalian.after' => 'The Return Date should be after the Borrowing Date.',
        ]);


        Transaksi::create($request->all());

        return redirect()->route('transaksi')->with("success","Transaction data has been successfully added!");
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
        $transaksi = Transaksi::find($id);
        $book = Book::all();
        $peminjam = Peminjam::all();
        return view('transaksi.edit', compact('transaksi', 'book', 'peminjam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $transaksi = Transaksi::find($id);

    // Validasi data
    $request->validate([
        'id_buku' => 'required|exists:tb_buku,id',
        'id_peminjam' => 'required|exists:tb_peminjam,id',
        'tanggal_peminjaman' => 'required|date',
        'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
    ], [
        'id_buku.required' => 'The Title Book field is required.',
        'id_buku.exists' => 'The selected Title Book does not exist.',
        'id_peminjam.required' => 'The Borrower Name field is required.',
        'id_peminjam.exists' => 'The selected Borrower Name does not exist.',
        'tanggal_peminjaman.required' => 'The Borrowing Date field is required.',
        'tanggal_peminjaman.date' => 'The Borrowing Date should be a valid date.',
        'tanggal_pengembalian.required' => 'The Return Date field is required.',
        'tanggal_pengembalian.date' => 'The Return Date should be a valid date.',
        'tanggal_pengembalian.after' => 'The Return Date should be after the Borrowing Date.',
    ]);

    // Cek apakah data yang ingin diubah sama dengan yang sebelumnya
    if (
        $request->id_buku == $transaksi->id_buku &&
        $request->id_peminjam == $transaksi->id_peminjam &&
        $request->tanggal_peminjaman == $transaksi->tanggal_peminjaman &&
        $request->tanggal_pengembalian == $transaksi->tanggal_pengembalian
    ) {
        return redirect()->route('transaksi.edit', $transaksi->id)->with("error1", "The data you're trying to edit is the same as before.");
    }

    // Jika data yang diubah berbeda dan peminjam belum pernah meminjam buku yang sama, proses pembaruan
    $transaksi->update($request->all());

    return redirect()->route('transaksi')->with("success", "Transaction data has been successfully updated!");
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi= Transaksi::find($id);
        $transaksi->delete();
        return redirect()->route("transaksi")->with("success","Transaction data has been successfully deleted!");
    }
}
