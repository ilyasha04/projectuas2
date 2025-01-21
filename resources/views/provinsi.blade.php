@extends('layout')

@section('title', 'Provinsi')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Peta Provinsi</h1>
    <p class="text-muted text-center">
        Peta ini menampilkan lokasi setiap provinsi di Indonesia. Anda dapat mengganti mode tampilan peta antara OpenStreetMap, Satellite View, dan Dark Mode menggunakan kontrol peta.
    </p>
    <div id="map" style="height: 400px;" class="mb-3"></div>
</div>

<script>
    // Inisialisasi Peta dengan minZoom
    var map = L.map('map', {
        center: [-2.5489, 118.0149], // Fokus ke Indonesia
        zoom: 5,                    // Zoom awal
        minZoom: 5                  // Zoom minimal
    });

    // Opsi Tile Layer
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    });

    var satellite = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 17,
        attribution: '© OpenTopoMap contributors'
    });

    var dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: '© CartoDB contributors'
    });

    // Tambahkan OSM sebagai default
    osm.addTo(map);

    // Layer Control untuk Pilihan Peta
    var baseMaps = {
        "OpenStreetMap": osm,
        "Satellite View": satellite,
        "Dark Mode": dark
    };

    L.control.layers(baseMaps).addTo(map);

    // Ambil Data Provinsi dari Server
    fetch('/api/provinsi')
        .then(response => response.json())
        .then(data => {
            data.forEach(provinsi => {
                // Tambahkan Marker ke Peta
                L.marker([provinsi.latitude, provinsi.longitude])
                    .addTo(map)
                    .bindPopup(`
                        <b>${provinsi.name}</b><br>
                        Alt Name: ${provinsi.alt_name}
                    `);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>
@endsection
