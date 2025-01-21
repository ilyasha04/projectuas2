@extends('layout')

@section('title', 'Tentang Kami')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Tentang saya</h1>
    <div class="row">
        @foreach ($teamMembers as $member)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow">
                    <!-- Tambahkan kelas 'card-img-uniform' -->
                    <img src="{{ $member['photo'] }}" class="card-img-top card-img-uniform" alt="Foto {{ $member['name'] }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $member['name'] }}</h5>
                        <p class="card-text text-muted">{{ $member['role'] }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ $member['github'] }}" class="btn btn-outline-dark btn-sm me-2" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="{{ $member['instagram'] }}" class="btn btn-outline-danger btn-sm" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
