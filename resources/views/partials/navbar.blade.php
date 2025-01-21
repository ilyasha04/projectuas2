<nav class="navbar navbar-expand-lg" style="background: linear-gradient(45deg, #28a745, #17a2b8);">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">Website Saya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Peta Tematik Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="petaTematikDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Peta Tematik
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="petaTematikDropdown">
                        <li><a class="dropdown-item" href="{{url('/populasi')}}">Populasi</a></li>
                        <li><a class="dropdown-item" href="{{url('/industri')}}">Ekonomi</a></li>
                        <li><a class="dropdown-item" href="{{url('/bencana')}}">Lingkungan</a></li>
                    </ul>
                </li>
                <!-- Other Menu Items -->
             
                <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('kabkota') }}">Kabkota</a>
</li>
<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('provinsi') }}">Provinsi</a>
</li>
<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('tentang') }}">Tentang Saya</a>
</li>
            </ul>
        </div>
    </div>
</nav>
