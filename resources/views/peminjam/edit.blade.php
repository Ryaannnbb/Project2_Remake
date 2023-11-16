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
                    <h6>Edit Borrower Data</h6>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <div class="card-body">
                    <form role="form" action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_peminjam" class="form-label">Borrower Name</label>
                            <input type="text" class="form-control form-control-lg @error('nama_peminjam') is-invalid @enderror" placeholder="Borrower Name" aria-label="Email" name="nama_peminjam" value="{{ $peminjam->nama_peminjam }}">
                            @error('nama_peminjam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Address</label>
                            <textarea class="form-control form-control-lg @error('alamat') is-invalid @enderror" placeholder="Address" name="alamat">{{ $peminjam->alamat }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">Phone Number</label>
                            <input type="text" class="form-control form-control-lg @error('no_telepon') is-invalid @enderror" placeholder="Phone Number" aria-label="Email" name="no_telepon" value="{{ $peminjam->no_telepon }}">
                            @error('no_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
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
