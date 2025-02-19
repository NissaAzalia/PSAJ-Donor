<x-app-layout>
    <div class="bg-gray-100 flex min-h-screen">
        <x-sidebar />
        <div class="bg-white p-6 rounded-lg shadow-lg w-[900px] mx-8 my-8">
            
            <!-- Cek apakah user sudah mendaftar -->
            @if($pendaftar)
                <!-- Header Profil -->
                <div class="flex gap-[300px] items-center mb-6">
                    <div class="bg-[#B20600] text-white p-4 h-[90px] w-[400px] rounded-lg">
                        <h2 class="text-xl font-bold">{{ $pendaftar->nama }}</h2>
                        <p>{{ $pendaftar->nohp }}</p>
                    </div>
                    <div class="bg-gray-200 p-4 h-[90px] w-[100px] rounded-lg flex items-center justify-center">
                        <img src="{{ asset('image/blood.png') }}" alt="Blood drop icon" class="w-6 mr-2">
                        <span class="text-3xl font-bold">{{ $pendaftar->golongan_darah }}</span>
                    </div>
                </div>

                <!-- Informasi Pendaftar -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-gray-200 p-4 rounded-lg text-left shadow">
                        <p class="text-gray-600">Umur</p>
                        <p class="text-2xl font-bold">{{ $pendaftar->umur }} tahun</p>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg text-left shadow">
                        <p class="text-gray-600">Jenis Kelamin</p>
                        <p class="text-2xl font-bold">{{ $pendaftar->jenis_kelamin }}</p>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg text-left shadow">
                        <p class="text-gray-600">Riwayat Kesehatan</p>
                        <p class="text-2xl font-bold">{{ $pendaftar->riwayat_kesehatan }}</p>
                    </div>
                </div>
            @else
                <p class="text-gray-600 text-center text-xl">Anda belum mendaftar sebagai pendonor.</p>
            @endif
        </div>
    </div>
</x-app-layout>
