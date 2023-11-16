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
@if (session('warning'))
    <script>
        Swal.fire({
            icon:'error',
            title: 'Oops...',
            text: '{{ session("warning") }}'
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
                        <h6>Authors table</h6>
                    </div>
                    <div class="col-6">
                        <div style="text-align:right">
                            <a href="{{ route('pengarang.create') }}">
                                <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-right: 20px;">Add</button>
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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Authors Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Year of birth</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pengarang->count() > 0)
                                @foreach ($pengarang as $pg)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$loop->iteration}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $pg->nama_pengarang }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $pg->tahun_kelahiran }}</span>
                                        </td>
                                            <td class="align-middle text-center">
                                            <a href="{{ route('pengarang.edit', $pg->id) }}" class="btn btn-secondary btn-xs mb-n1 mt-n1" data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="deleteform{{ $pg->id }}" method="POST" action="{{ route('pengarang.destroy', $pg->id) }}" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-xs mb-n1 mt-n1" onclick="event.preventDefault(); showDeleteConfirmation({{ $pg->id }})" data-toggle="tooltip" data-original-title="Delete user">
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
    function showDeleteConfirmation(PgId) {
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
                document.getElementById('deleteform' + PgId).submit();
            }
        });
    }
</script>

@endsection
