@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h6>Add peminjam Data</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card-body">
                            <form role="form" action="{{ route('peminjam.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_peminjam" class="form-label">Borrower Name</label>
                                    <input type="text" class="form-control form-control-lg @error('nama_peminjam') is-invalid @enderror" placeholder="Borrower Name" aria-label="Email" name="nama_peminjam" value="{{ old('nama_peminjam') }}">
                                    @error('nama_peminjam')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Address</label>
                                    <textarea class="form-control form-control-lg @error('alamat') is-invalid @enderror" placeholder="Address" aria-label="Email" name="alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg @error('no_telepon') is-invalid @enderror" placeholder="Phone Number" aria-label="Phone Number" name="no_telepon" value="{{ old('no_telepon') }}">
                                    @error('no_telepon')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Add</button>
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
