<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Google Maps</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}"></script>
    <script>
        function initMap() {
            const location = {
                lat: -7.2968674,
                lng: 112.7623556
            }; // Contoh koordinat Surabaya
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            new google.maps.Marker({
                position: location,
                map: map,
                title: "Lokasi Anda"
            });
        }
    </script>
</head>

<body onload="initMap()" class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    {{-- <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <img src="./Logo/Logo.png" alt="logo" class="h-20 w-20 mr-2">
                <span class="text-2xl font-bold text-blue-600">ScaraPlay</span>
            </a>
        </div>
    </nav> --}}

    <x-navbar></x-navbar>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6 flex-grow">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-blue-600">Lokasi Toko Agus Jaya</h2>
            <div id="map" class="w-full h-96 rounded-lg shadow-md mb-6"></div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4 mt-6 w-2/3 mx-auto text-center">
            <h3 class="text-lg font-bold mb-2 text-blue-600">Detail Lokasi</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm">
                <li><strong>Lokasi Google Maps : </strong><a href="https://maps.app.goo.gl/i74u3zZCicoSvjgq7"
                        target="_blank" class="text-blue-600 hover:underline">
                        <i class="fas fa-map-marker-alt"></i>
                        Lihat Lokasi
                    </a></li>
                <li><strong>Alamat:</strong> Jl. Raya Manyar No.68, Menur Pumpungan, Kec. Sukolilo, Surabaya, Jawa Timur
                    60118</li>
                <li><strong>Fasilitas:</strong> Lokasi ini dilengkapi dengan area parkir yang memadai, tersedia minuman
                    dan akses yang mudah dijangkau.</li>
                <li><strong>Jam Buka:</strong> Buka Setiap Hari, pukul 07:30 - 21:00 WIB</li>
                <li><strong></strong> Jum'at Libur</li>
            </ul>
        </div>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
<script>
    function toggleUserMenu() {
        document.getElementById('userMenu').classList.toggle('hidden');
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('userMenu');
        const button = e.target.closest('button');

        if (!e.target.closest('#userMenu') && !button) {
            menu?.classList.add('hidden');
        }
    });
</script>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        const icon = this.querySelector('i');

        menu.classList.toggle('hidden');
        if (menu.classList.contains('hidden')) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        } else {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        }
    });
</script>

</html>
