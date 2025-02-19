<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<div class="w-1/5 h-screen bg-[#B20600] p-4 pt-8">
    <nav class="space-y-4">
        @php
            $routeName = Route::currentRouteName(); // Ambil nama route yang sedang aktif
        @endphp

        <!-- Daftar -->
        <div class="border-b border-white">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center justify-between p-4 transition 
               {{ $routeName === 'dashboard' ? 'bg-white text-red-700 font-bold' : 'text-white hover:bg-white hover:text-red-700' }}">
                <div class="flex items-center gap-4">
                    <i class="fas fa-clipboard-list fa-lg"></i>
                    <span class="font-bold text-lg">Daftar</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <!-- Profil -->
        <div class="border-b border-white">
            <a href="{{ route('profile.profil') }}" 
               class="flex items-center justify-between p-4 transition 
               {{ $routeName === 'profile.show' ? 'bg-white text-red-700 font-bold' : 'text-white hover:bg-white hover:text-red-700' }}">
                <div class="flex items-center gap-4">
                    <i class="fas fa-user mr-2 fa-lg"></i>
                    <span class="font-bold text-lg">Profil</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <!-- Logout -->
        <div class="bg-[#B20600] p-4 border-b border-white hover:bg-white hover:text-red-700 transition">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-white text-lg font-semibold w-full text-left hover:text-red-700">
                    Logout
                </button>
            </form>
        </div>
    </nav>
</div>
