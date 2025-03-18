<div id="dataDiriModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3 max-h-[80vh] overflow-y-auto relative">
        <!-- Tombol Close -->
        <button onclick="document.getElementById('dataDiriModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-700 hover:text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h2 class="text-xl text-center font-bold mb-4 text-red-700">Form Biodata</h2>
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="nama">Nama</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="nama" name="nama" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="umur">Umur</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="number" id="umur" name="umur" required>
                
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="jenis_kelamin">Jenis Kelamin</label>
                <div class="flex gap-4">
                    <div>
                        <input type="radio" id="male" name="jenis_kelamin" value="Laki-laki" class="mr-2" required>
                        <label for="male">Laki-laki</label>
                    </div>
                    <div>
                        <input type="radio" id="female" name="jenis_kelamin" value="Perempuan" class="mr-2" required>
                        <label for="female">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="golongan_darah">Golongan Darah</label>
                 <!-- Dropdown langsung aktif tanpa checkbox -->
                <select id="golongan_darah" name="golongan_darah" class="w-full px-3 py-2 border border-gray-300 rounded">
                    <option value="" disabled selected>Pilih Golongan Darah</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
                
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-1" for="nohp">No Hp</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded" type="number" id="nohp" name="nohp" required>
            </div>
            
            <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded">Kirim</button>
        </form>
        
    </div>
</div>
