<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function index()
    {
        if (Auth::user() == null)
        {
            return view("auth.login");
        }
        $book = Book::all();
        return view("book.index", compact("book"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Pengarang::all();
        $categories = Kategori::all();
        return view("book.create", compact("authors", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'path_buku' => 'required|image|mimes:jpeg,png,gif|max:2048',
            'judul_buku' => [
                'required',
                'unique:tb_buku,judul_buku',
                'regex:/^[A-Za-z\s]+$/',
                'max:100',
            ],
            'tahun_terbit' => 'required|numeric|min:1900|max:2023',
            'isbn' => [
                'required',
                'regex:/^[0-9-]+$/',
                Rule::unique('tb_buku', 'isbn'),
            ],
            'id_pengarang' => 'required|exists:tb_pengarang,id',
            'id_kategori' => 'required|exists:tb_kategori,id',
        ], [
            'path_buku.required' => 'The book photo is required.',
            'path_buku.image' => 'The selected file must be an image.',
            'path_buku.mimes' => 'The image must be in JPEG, PNG, or GIF format.',
            'path_buku.max' => 'The image size should not exceed 2MB.',
            'judul_buku.required' => 'The title book is required.',
            'judul_buku.unique' => 'The title book is already in use.',
            'judul_buku.regex' => 'The title book should contain only letters and spaces.',
            'judul_buku.max' => 'The title book should not exceed 100 characters.',
            'tahun_terbit.required' => 'The publication year is required.',
            'tahun_terbit.numeric' => 'The publication year must be a number.',
            'tahun_terbit.min' => 'The minimum publication year is 1900.',
            'tahun_terbit.max' => 'The maximum publication year is 2023.',
            'isbn.required' => 'The ISBN is required.',
            'isbn.regex' => 'The ISBN may only contain numbers and hyphens.',
            'isbn.unique' => 'The ISBN is already in use.',
            'id_pengarang.required' => 'Please choose an author.',
            'id_pengarang.exists' => 'The selected author does not exist.',
            'id_kategori.required' => 'Please choose a category.',
            'id_kategori.exists' => 'The selected category does not exist.',
        ]);

        // Cek apakah buku dengan nama yang sama sudah ada
        $existingBook = Book::where('judul_buku', $request->judul_buku)->first();

        if ($existingBook) {
            return redirect()->route('book')->with("error", "A book with the same title already exists. Please enter a different title.");
        }

        $book = $request->all();

        if ($image = $request->file('path_buku')) {
            $path = 'assets/img/photo/';
            $extension = $image->getClientOriginalExtension(); // Mendapatkan ekstensi asli file
            $hashName = hash('md5', time()) . '.' . $extension; // Menghasilkan nama file yang di-hash
            $image->move($path, $hashName);
            $book['path_buku'] = $hashName;
        }


        Book::create($book);

        return redirect()->route('book')->with("success", "Book data has been successfully added.");
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
        $book = Book::find($id);
        $authors = Pengarang::all();
        $categories = Kategori::all();

        return view('book.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        // Memeriksa apakah data yang akan diubah sama dengan data sebelumnya   
        if (
            $request->judul_buku == $book->judul_buku &&
            $request->tahun_terbit == $book->tahun_terbit &&
            $request->isbn == $book->isbn &&
            $request->id_pengarang == $book->id_pengarang &&
            $request->id_kategori == $book->id_kategori
        ) {
            return redirect()->back()->with("error", "The data you're trying to edit is the same as before.");
        }

        $bookData = $request->except('path_buku');

        $request->validate([
            'path_buku' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'judul_buku' => [
                'required',
                Rule::unique('tb_buku', 'judul_buku')->ignore($book->id),
                'regex:/^[A-Za-z\s]+$/'
            ],
            'tahun_terbit' => 'required|numeric|min:1900|max:2023',
            'isbn' => [
                'required',
                'regex:/^[0-9-]+$/',
                Rule::unique('tb_buku', 'isbn')->ignore($book->id)
            ],
            'id_pengarang' => 'required|exists:tb_pengarang,id',
            'id_kategori' => 'required|exists:tb_kategori,id',
        ], [
            'path_buku.image' => 'The selected file must be an image.',
            'path_buku.mimes' => 'The image must be in JPEG, PNG, or GIF format.',
            'path_buku.max' => 'The image size should not exceed 2MB.',
            'judul_buku.required' => 'The title book is required.',
            'judul_buku.unique' => 'The title book is already in use. Please enter a different title.',
            'judul_buku.regex' => 'The title book should contain only letters and spaces.',
            'tahun_terbit.required' => 'The publication year is required.',
            'tahun_terbit.numeric' => 'The publication year must be a number.',
            'tahun_terbit.min' => 'The minimum publication year is 1900.',
            'tahun_terbit.max' => 'The maximum publication year is 2023.',
            'isbn.required' => 'The ISBN is required.',
            'isbn.regex' => 'The ISBN format is invalid.',
            'isbn.unique' => 'The ISBN is already in use. Please enter a different ISBN.',
            'id_pengarang.required' => 'Please choose an author.',
            'id_pengarang.exists' => 'The selected author does not exist.',
            'id_kategori.required' => 'Please choose a category.',
            'id_kategori.exists' => 'The selected category does not exist.',
        ]);

        if ($image = $request->file('path_buku')) {
            $path = 'assets/img/photo/';

            // Dapatkan nama file lama dari database
            $oldFileName = $book->path_buku;

            $extension = $image->getClientOriginalExtension(); // Dapatkan ekstensi asli file
            $hashedFileName = hash('md5', time()) . '.' . $extension; // Buat nama file yang di-hash

            $image->move($path, $hashedFileName);
            $bookData['path_buku'] = $hashedFileName;

            // Hapus file lama jika ada
            if ($oldFileName && file_exists($path . $oldFileName)) {
                unlink($path . $oldFileName);
            }
        }


        $book->update($bookData);

        return redirect()->route('book')->with("success", "Book data has been successfully updated.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if ($book) {
            $path_buku = $book->path_buku;
            $path = public_path('assets/img/photo/' . $path_buku);

            if (File::exists($path)) {
                File::delete($path);
            }

            $book->delete();

            return redirect()->route("book")->with("success", "Book data has been successfully deleted.");
        }

        return redirect()->route("book")->with("warning", "Book not found or already deleted.");
    }
}
