@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h6>Add Pengarang Data</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card-body">
                            <form role="form" action="{{ route('pengarang.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_pengarang" class="form-label">Authors Name</label>
                                    <input type="text" class="form-control form-control-lg @error('nama_pengarang') is-invalid @enderror" placeholder="Authors Name" aria-label="Email" name="nama_pengarang" value="{{ old('nama_pengarang') }}">
                                    @error('nama_pengarang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun_kelahiran" class="form-label">Year of birth</label>
                                    <input type="number" class="form-control form-control-lg @error('tahun_kelahiran') is-invalid @enderror" placeholder="Year of birth" aria-label="Email" name="tahun_kelahiran" value="{{ old('tahun_kelahiran') }}">
                                    @error('tahun_kelahiran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
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
