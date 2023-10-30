@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card mb-4">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-6">
                    <h6>Add Book Data</h6>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <div class="card-body">
                    <form role="form" action="{{ route('book.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Path Buku" aria-label="Email" name="path_buku" value="{{ $book->path_buku }}">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Title Book" aria-label="Email" name="judul_buku" value="{{ $book->judul_buku }}">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" placeholder="Publication Year" aria-label="Publication Year" name="tahun_terbit" min="1900" max="2023" value="{{ $book->tahun_terbit }}">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" placeholder="ISBN" aria-label="ISBN" name="isbn" value="{{ $book->isbn }}">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" placeholder="Id Pengarang" aria-label="Email" name="id_pengarang" value="{{ $book->id_pengarang }}">
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-lg" placeholder="Id Kategori" aria-label="Email" name="id_kategori" value="{{ $book->id_kategori }}">
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
    <footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
            © <script>
                document.write(new Date().getFullYear())
            </script>,
            made with <i class="fa fa-heart"></i> by
            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
            for a better web.
            </div>
        </div>
        <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
            </li>
            </ul>
        </div>
        </div>
    </div>
    </footer>
</div>

@endsection
