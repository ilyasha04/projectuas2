@extends('layout')

@section('title', 'Peta Pulau Jawa')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Peta Pulau Jawa Berdasarkan populasi Penduduk</h1>
    <p class="text-muted text-center">provinsi di Pulau Jawa diberi warna berdasarkan tingkat populasi penduduknya.</p>
    <div style="display: flex; justify-content: space-between;">
        <div id="map" style="height: 400px; width: 80%;"></div>
        <!-- Tempat untuk legend di samping map -->
        <div id="legend" style="width: 15%; padding-left: 20px;">
            <div class="info legend">
                <div>
                <i style="background: #D73027; width: 20px; height: 20px; display: inline-block;"></i> > 15,000<br>
                <i style="background: #FC8D59; width: 20px; height: 20px; display: inline-block;"></i> 12,000 - 15,000<br>
                <i style="background: #FEE08B; width: 20px; height: 20px; display: inline-block;"></i> 10,000 - 12,000<br>
                <i style="background: #D9EF8B; width: 20px; height: 20px; display: inline-block;"></i> 9,000 - 10,000<br>
                <i style="background: #91CF60; width: 20px; height: 20px; display: inline-block;"></i> 7,000 - 9,000<br>
                <i style="background: #1A9850; width: 20px; height: 20px; display: inline-block;"></i> 5,000 - 7,000<br>
                <i style="background: #4575B4; width: 20px; height: 20px; display: inline-block;"></i> < 5,000
                </div>
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
    function getColor(density) {
        return density > 15000 ? '#D73027' : // Merah
           density > 12000 ? '#FC8D59' : // Oranye Tua
           density > 10000 ? '#FEE08B' : // Kuning
           density > 9000  ? '#D9EF8B' : // Hijau Muda
           density > 7000  ? '#91CF60' : // Hijau
           density > 5000  ? '#1A9850' : // Hijau Tua
                             '#4575B4';  // Biru
    }

    // Gaya layer
    function style(feature) {
        return {
            fillColor: getColor(feature.properties.density),
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
            Kepadatan Penduduk: ${feature.properties.density} jiwa/km²
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
