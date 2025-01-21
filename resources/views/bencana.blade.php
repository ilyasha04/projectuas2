@extends('layout')

@section('title', 'Daerah Bencana dan Sektor Ekonomi Utama')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daerah Bencana dan Sektor Ekonomi Utama</h1>
    <p class="text-muted text-center">Setiap provinsi di Pulau Jawa diberi warna berdasarkan jumlah kejadian bencana yang terjadi di provinsi tersebut.</p>
    <div class="map-container">
        <div id="map" style="height: 400px; width: 75%; display: inline-block;"></div>
        <!-- Tempat untuk legend di samping map -->
        <div id="legend"  style="display: inline-block; width: 20%; padding-left: 20px;">
            <div>
                <i style="background: #8B0000; width: 20px; height: 20px; display: inline-block;"></i> 0 - 50<br>
                <i style="background: #FF4500; width: 20px; height: 20px; display: inline-block;"></i> 50 - 200<br>
                <i style="background: #FFA500; width: 20px; height: 20px; display: inline-block;"></i> 200 - 500<br>
                <i style="background: #FFD700; width: 20px; height: 20px; display: inline-block;"></i> 500 - 1000<br>
                <i style="background: #32CD32; width: 20px; height: 20px; display: inline-block;"></i> 1000 - 1500<br>
                <i style="background: #4682B4; width: 20px; height: 20px; display: inline-block;"></i> 1500 - 2000<br>
                <i style="background: #00008B; width: 20px; height: 20px; display: inline-block;"></i> 2000+
            </div>
        </div>
    </div>
</div>

<script>
    // Inisialisasi peta
    var map = L.map('map', {
        center: [-7.5, 110], // Fokus awal di Pulau Jawa
        zoom: 7,
        minZoom: 7,
        maxZoom: 10
    });

   
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


    // Fungsi warna berdasarkan jumlah bencana
    function getColor(bencana) {
        return bencana <= 50    ? '#8B0000' :  // Dark Red untuk 0 - 50
           bencana <= 200   ? '#FF4500' :  // Orange Red untuk 50 - 200
           bencana <= 500   ? '#FFA500' :  // Orange untuk 200 - 500
           bencana <= 1000  ? '#FFD700' :  // Gold untuk 500 - 1000
           bencana <= 1500  ? '#32CD32' :  // Lime Green untuk 1000 - 1500
           bencana <= 2000  ? '#4682B4' :  // Steel Blue untuk 1500 - 2000
                              '#00008B';   // Dark Blue untuk 2000+
    }

    // Gaya layer
    function style(feature) {
        return {
            fillColor: getColor(feature.properties.bencana),  // Gunakan properti bencana
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    // Interaksi layer
    function onEachFeature(feature, layer) {
        layer.bindPopup(`
            <strong>${feature.properties.name}</strong><br>
            Banyak kejadian bencana: ${feature.properties.bencana} Kejadian
        `);
    }

    // Ambil data GeoJSON
    fetch('/assets/js/jawa_population_density.json')  // Pastikan Anda memiliki data GeoJSON yang sesuai
        .then(response => response.json())
        .then(data => {
            L.geoJSON(data, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);
        })
        .catch(error => console.error('Error loading GeoJSON:', error));
</script>
@endsection
