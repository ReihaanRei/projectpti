<nav class="bg-blue-600 p-4 shadow-lg sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    <div class="flex items-center">
      <a href="#" class="flex items-center">
        <i class="fas fa-helmet-safety text-white text-2xl mr-2"></i>
        <h1 class="text-white text-xl font-bold">Toko Agus Jaya</h1>
      </a>
    </div>

    <!-- Desktop Menu -->
    <div class="hidden md:flex gap-6 items-center">
      <a href="/dashboard"
        class="nav-link text-white hover:bg-blue-700 rounded px-3 py-2 bg-blue-700 font-semibold underline">
        Beranda
      </a>

      <a href="/katalog"
        class="nav-link text-white hover:bg-blue-700 rounded px-3 py-2">
        Katalog
      </a>

      <!-- Simulasi user login -->
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
          A
        </div>
        <span class="text-white">Agus Jaya</span>
        <button class="text-blue-100 hover:text-white transition">
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </div>

      <!-- Jika belum login (ganti manual kalau perlu) -->
      <!--
      <a href="#" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
        Login
      </a>
      -->
    </div>

    <!-- Tombol Menu Mobile -->
    <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
      <i class="fas fa-bars text-xl"></i>
    </button>
  </div>

  <!-- Menu Mobile -->
  <div class="md:hidden hidden bg-blue-700 px-4 py-2" id="mobile-menu">
    <div class="flex flex-col space-y-3">
      <a href="/dashboard"
        class="text-white py-2 border-b px-2 rounded hover:bg-blue-800 border-blue-600 bg-blue-800 font-semibold underline">
        Dashboard
      </a>

      <a href="/katalog"
        class="text-white py-2 border-b px-2 rounded hover:bg-blue-800 border-blue-600">
        Katalog
      </a>

      <!-- Simulasi user login -->
      <div class="flex items-center justify-between py-2 border-b border-blue-600">
        <span class="text-white">Halo, Agus Jaya</span>
        <button class="text-red-200 hover:text-white">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </div>

      <!-- Jika belum login -->
      <!--
      <a href="#" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium text-center">
        Login
      </a>
      -->
    </div>
  </div>
</nav>

<!-- Script untuk toggle menu mobile -->
<script>
  const menuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
