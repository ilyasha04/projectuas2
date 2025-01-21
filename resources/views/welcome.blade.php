@extends('layout')

@section('title', 'Home Page')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Sisi Kiri: Gambar -->
        <div class="col-md-6 mb-4">
            <img src="https://th.bing.com/th/id/OIP.OTlKmiCl2zwm2CSuxqWRvAHaEJ?w=305&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" class="img-fluid rounded" alt="Gambar SIG">
        </div>
        <!-- Sisi Kanan: Teks -->
        <div class="col-md-6">
            <h1>Selamat Datang di MyWebsite SIG</h1>
            <p class="lead">Sistem Informasi Geografis yang membantu dalam mengakses data geografis secara efektif dan efisien, khususnya pulau Jawa.</p>
            <ul>
                <li>Populasi: Data kepadatan penduduk</li>
                <li>Ekonomi: Daerah industri dan sektor ekonomi utama</li>
                <li>Lingkungan: Daerah rawan bencana dan polusi udara</li>
            </ul>
            <a href="#" class="btn btn-primary btn-lg mt-3">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</div>
@endsection
