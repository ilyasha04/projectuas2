@extends('layout')

@section('title', 'Daerah Industri dan Sektor Ekonomi Utama')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daerah Industri dan Sektor Ekonomi Utama</h1>
    <p class="text-muted text-center">provinsi di Pulau Jawa diberi warna berdasarkan tingkat populasi penduduk dan sektor ekonomi utama yang ada.</p>
    <div class="map-container">
        <div id="map" style="height: 400px; width: 75%; display: inline-block;"></div>
        <!-- Tempat untuk legend di samping map -->
        <div id="legend"  style="display: inline-block; width: 10%; padding-left: 20px;">
            
            <div>
                <i style="background: #8B0000; width: 20px; height: 20px; display: inline-block;"></i> 0 - 2<br>
                <i style="background: #FF4500; width: 20px; height: 20px; display: inline-block;"></i> 2 - 5<br>
                <i style="background: #FFA500; width: 20px; height: 20px; display: inline-block;"></i> 5 - 10<br>
                <i style="background: #FFD700; width: 20px; height: 20px; display: inline-block;"></i> 10 - 20<br>
                <i style="background: #ADFF2F; width: 20px; height: 20px; display: inline-block;"></i> 20 - 30<br>
                <i style="background: #32CD32; width: 20px; height: 20px; display: inline-block;"></i> 30 - 40<br>
                <i style="background: #4682B4; width: 20px; height: 20px; display: inline-block;"></i> 40+
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


    // Fungsi warna berdasarkan density
    function getColor(industri) {
        return industri <= 2    ? '#8B0000' : // Dark Red
           industri <= 5    ? '#FF4500' : // Orange Red
           industri <= 10   ? '#FFA500' : // Orange
           industri <= 20   ? '#FFD700' : // Gold
           industri <= 30   ? '#ADFF2F' : // Green Yellow
           industri <= 40   ? '#32CD32' : // Lime Green
                              '#4682B4';  // Steel Blue
    }

    // Gaya layer
    function style(feature) {
        return {
            fillColor: getColor(feature.properties.industri),  // Gunakan properti industri
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
            Banyak Industri: ${feature.properties.industri} Kawasan
        `);
    }

    // Ambil data GeoJSON
    fetch('/assets/js/jawa_population_density.json')
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
