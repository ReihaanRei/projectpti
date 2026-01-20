<nav class="bg-blue-600 p-4 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <i class="fas fa-helmet-safety text-white text-2xl"></i>
            <span class="text-white text-xl font-bold">Toko Agus Jaya</span>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-6">

            <a href="{{ route('dashboard') }}"
                class="text-white px-3 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-700 underline font-semibold' : '' }}">
                Beranda
            </a>

            <a href="{{ route('katalog') }}"
                class="text-white px-3 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('katalog') ? 'bg-blue-700 underline font-semibold' : '' }}">
                Katalog
            </a>

            <a href="{{ route('my.transactions') }}"
                class="text-white px-3 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('my.transactions') ? 'bg-blue-700 underline font-semibold' : '' }}">
                Transaksi Saya
            </a>

            {{-- USER LOGIN --}}
            @auth
                <div class="relative">
                    <button onclick="toggleUserMenu()"
                        class="flex items-center gap-2 bg-blue-700 px-3 py-2 rounded-lg text-white hover:bg-blue-800 transition">
                        
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>

                    <!-- Dropdown -->
                    <div id="userMenu"
                        class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden z-50">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                    Login
                </a>
            @endguest

        </div>

        <!-- Mobile Button -->
        <button class="md:hidden text-white" id="mobile-menu-button">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-blue-700 px-4 py-3" id="mobile-menu">
        <a href="{{ route('dashboard') }}" class="block text-white py-2 hover:bg-blue-800 rounded">
            Beranda
        </a>
        <a href="{{ route('katalog') }}" class="block text-white py-2 hover:bg-blue-800 rounded">
            Katalog
        </a>
        <a href="{{ route('my.transactions') }}" class="block text-white py-2 hover:bg-blue-800 rounded">
            Transaksi Saya
        </a>

        @auth
            <div class="mt-3 border-t border-blue-500 pt-3 space-y-2">
                <div class="text-white font-semibold">
                    {{ Auth::user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg flex items-center justify-center gap-2">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        @endauth

        @guest
            <a href="{{ route('login') }}"
                class="block mt-3 bg-white text-blue-600 text-center py-2 rounded font-medium">
                Login
            </a>
        @endguest
    </div>
</nav>
