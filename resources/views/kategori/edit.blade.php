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
                    <h6>Edit Category Data</h6>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <div class="card-body">
                    <form role="form" action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Category Name</label>
                            <input type="text" class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror" placeholder="Category Name" aria-label="Email" name="nama_kategori" value="{{ $kategori->nama_kategori }}">
                            @error('nama_kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_kategori" class="form-label">Category Description</label>
                            <textarea class="form-control form-control-lg @error('deskripsi_kategori') is-invalid @enderror" placeholder="Category Description" aria-label="Email" name="deskripsi_kategori">{{ $kategori->deskripsi_kategori }}</textarea>
                            @error('deskripsi_kategori')
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
