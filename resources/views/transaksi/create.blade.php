@extends('layout.app')

@section('content')

@if (session('error1'))
    <script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Data youre trying to edit is the same as before',
        // text: '{{ session("error1") }}',
    })
    </script>
@endif
@if (session('error2'))
    <script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session("error2") }}',
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
                            <h6>Add Transaction Data</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card-body">
                            <form role="form" action="{{ route('transaksi.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_buku" class="form-label">Book Name</label>
                                    <select class="form-select form-select-lg @error('id_buku') is-invalid @enderror" name="id_buku" id="id_buku">
                                        <option value="">Choose Book</option>
                                        @foreach($book as $books)
                                            <option value="{{ $books->id }}" @if(old('id_buku') == $books->id) selected @endif>{{ $books->judul_buku }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_buku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_peminjam" class="form-label">Borrower Name</label>
                                    <select class="form-select form-select-lg @error('id_peminjam') is-invalid @enderror" name="id_peminjam" id="id_peminjam">
                                        <option value="">Choose Borrower</option>
                                        @foreach($peminjam as $peminjams)
                                            <option value="{{ $peminjams->id }}" @if(old('id_peminjam') == $peminjams->id) selected @endif>{{ $peminjams->nama_peminjam }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_peminjam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_peminjaman" class="form-label">Borrowing Date</label>
                                    <input type="date" class="form-control form-control-lg @error('tanggal_peminjaman') is-invalid @enderror" placeholder="Borrowing Date" aria-label="Email" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}">
                                    @error('tanggal_peminjaman')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pengembalian" class="form-label">Return Date</label>
                                    <input type="date" class="form-control form-control-lg @error('tanggal_pengembalian') is-invalid @enderror" placeholder="Return Date" aria-label="Email" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}">
                                    @error('tanggal_pengembalian')
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
