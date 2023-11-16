@extends('layout.app')

@section('content')

@if (session('error'))
    <script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Data youre trying to edit is the same as before',
        // text: '{{ session("error") }}',
    })
    </script>
@endif

<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-6">
                    <h6>Edit Book Data</h6>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <div class="card-body">
                    <form role="form" action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- (Cross-Site Request Forgery) --}}
                        @method('PUT')
                        <div class="mb-3">
                            <label for="path_buku" class="form-label">Choose a book photo</label>
                            <input type="file" class="form-control form-control-lg @error('path_buku') is-invalid @enderror" aria-label="Email" name="path_buku" id="path_buku" accept="image/*">
                            @error('path_buku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if($book->path_buku)
                            <div class="mb-3">
                                <label for="current_image" class="form-label">Current Book Photo</label>
                                <img src="{{ asset('assets/img/photo/' . $book->path_buku) }}" alt="Current Book Photo" style="max-width: 100px; max-height: 100px;">
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Title Book</label>
                            <input type="text" class="form-control form-control-lg @error('judul_buku') is-invalid @enderror" placeholder="Title Book" aria-label="Email" name="judul_buku" value="{{ $book->judul_buku }}">
                            @error('judul_buku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Publication Year</label>
                            <input type="number" class="form-control form-control-lg @error('tahun_terbit') is-invalid @enderror" placeholder="Publication Year" aria-label="Publication Year" name="tahun_terbit" value="{{ $book->tahun_terbit }}">
                            @error('tahun_terbit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control form-control-lg @error('isbn') is-invalid @enderror" placeholder="ISBN" aria-label="ISBN" name="isbn" value="{{ $book->isbn }}">
                            @error('isbn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_pengarang" class="form-label">Author Name</label>
                            <select class="form-select form-select-lg @error('id_pengarang') is-invalid @enderror" name="id_pengarang" id="id_pengarang">
                                <option value="">Pilih seorang pengarang</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" @if($author->id == $book->id_pengarang) selected @endif>{{ $author->nama_pengarang }}</option>
                                @endforeach
                            </select>
                            @error('id_pengarang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Category Name</label>
                            <select class="form-select form-select-lg @error('id_kategori') is-invalid @enderror" name="id_kategori" id="id_kategori">
                                <option value="">Pilih sebuah kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $book->id_kategori) selected @endif>{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

@endsection
