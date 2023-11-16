@extends('layout.app')

@section('content')

@if (session('success'))
    <script>
        Swal.fire({
            icon:'success',
            title: 'Success',
            text: '{{ session("success") }}'
        });
    </script>
@endif
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-6">
                        <h6>Book table</h6>
                    </div>
                    <div class="col-6">
                        <div style="text-align:right">
                            <a href="{{ route('book.create') }}">
                                <button class="btn bg-gradient-dark px-3 mb-2 ms-2" style="margin-right: 20px;">Add</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Book Path</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title Book</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publication Year</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ISBN</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($book->count() > 0)
                                @foreach ($book as $bk)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$loop->iteration}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <img src="{{ asset('assets/img/photo/' . $bk->path_buku) }}" alt="Photo" width="50" height="auto">
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $bk->judul_buku }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $bk->tahun_terbit }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $bk->isbn }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $bk->author->nama_pengarang }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $bk->kategori->nama_kategori }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('book.edit', $bk->id) }}" class="btn btn-secondary btn-xs mb-n1 mt-n1" data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="deleteform{{ $bk->id }}" method="POST" action="{{ route('book.destroy', $bk->id) }}" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-xs mb-n1 mt-n1" onclick="event.preventDefault(); showDeleteConfirmation({{ $bk->id }})" data-toggle="tooltip" data-original-title="Delete user">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    function showDeleteConfirmation(bkId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteform' + bkId).submit();
            }
        });
    }
</script>

@endsection
