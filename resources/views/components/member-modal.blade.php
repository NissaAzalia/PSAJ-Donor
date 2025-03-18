@isset($anggota)

<div id="daftarDonorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3 max-h-[80vh] overflow-y-auto relative">
        <!-- Tombol Close -->
        <button onclick="document.getElementById('daftarDonorModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-700 hover:text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h2 class="text-xl text-center font-bold mb-4 text-red-700">Daftar Donor Darah</h2>
        <form action="{{ route('pendaftar.store') }}" method="POST">
            @csrf 
            <input type="hidden" name="anggota_id" value="{{ $anggota->id ?? '' }}">

            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="nama">Nama</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded" id="nama" name="nama" value="{{ is_array($anggota) ? ($anggota['nama'] ?? 'Data tidak ditemukan') : ($anggota->nama ?? 'Data tidak ditemukan') }}" readonly> 
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="umur">Umur</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="umur" name="umur" value="{{ $anggota->umur ?? '' }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="golongan_darah">Golongan Darah</label>
                <input type="text" id="golongan_darah" name="golongan_darah" value="{{ $anggota->golongan_darah ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded" readonly>
            </div>
           
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="riwayat_kesehatan">Riwayat Penyakit</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="riwayat_kesehatan" name="riwayat_kesehatan" required>
            </div>
            
            <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded">Kirim</button>
        </form>
    </div>
</div>
@endisset
