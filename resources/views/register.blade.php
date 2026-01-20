<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Register - UMKM Helm</title>
</head>
<body class="bg-gradient-to-br from-green-100 to-green-300 flex items-center justify-center min-h-screen font-sans">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-green-600 hover:underline flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0L3.586 10l4.707-4.707a1 1 0 011.414 1.414L6.414 10l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <h2 class="text-3xl font-extrabold text-center text-green-700 mb-6">Daftar Akun Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm text-gray-700 font-medium">Nama Lengkap</label>
                <input type="text" name="name" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                       placeholder="Nama Anda">
            </div>

            <div>
                <label class="block text-sm text-gray-700 font-medium">Username</label>
                <input type="text" name="username" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                       placeholder="Username unik Anda">
            </div>

            <div>
                <label class="block text-sm text-gray-700 font-medium">Password</label>
                <input type="password" name="password" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                       placeholder="••••••••">
            </div>

            <div>
                <label class="block text-sm text-gray-700 font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                       placeholder="••••••••">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition duration-200">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-green-600 hover:underline font-medium">Login</a>
        </p>
    </div>
</body>
</html>
