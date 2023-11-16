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
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{ asset('assets/img/welcome.jpg') }}');
                background-size: cover;">
                    <span class="mask bg-gradient-dark opacity-7"></span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"A library is a treasure trove of knowledge."</h4>
                    <p class="text-white position-relative">In the silence of a library, you can discover worlds, unravel mysteries, and explore the depths of human wisdom.</p>
                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"A library is a treasure trove of knowledge."</h4>
                    <p class="text-white position-relative">In the silence of a library, you can discover worlds, unravel mysteries, and explore the depths of human wisdom.</p>
                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"A library is a treasure trove of knowledge."</h4>
                    <p class="text-white position-relative">In the silence of a library, you can discover worlds, unravel mysteries, and explore the depths of human wisdom.</p>
                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"A library is a treasure trove of knowledge."</h4>
                    <p class="text-white position-relative">In the silence of a library, you can discover worlds, unravel mysteries, and explore the depths of human wisdom.</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
