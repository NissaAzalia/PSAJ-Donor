<div id="kuisionerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3 max-h-[80vh] overflow-y-auto relative">
        <!-- Tombol Close -->
        <button onclick="document.getElementById('kuisionerModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-700 hover:text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h2 class="text-xl font-bold mb-4 text-red-700">Form Kuisioner</h2>
        <form>
            <div class="border-t border-gray-300 pt-4">
                <h2 class="text-red-600 font-semibold mb-2">Informasi Pribadi</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="nama">Nama</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="nama" name="nama">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="umur">Umur</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded" type="number" id="umur" name="umur">
                </div>
            </div>

            <div class="border-t border-gray-300 pt-4">
                <h2 class="text-red-600 font-semibold mb-2">Kondisi Kesehatan</h2>
                
                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda merasa sehat dan tidak dalam kondisi kelelahan?</p>
                    <div class="w-full flex items-center">
                        <label class="flex items-center">
                            <input class="mr-2" type="radio" id="sehat-ya" name="sehat" value="ya"> Ya
                        </label>
                        <label class="flex items-center ml-8">
                            <input class="mr-2" type="radio" id="sehat-tidak" name="sehat" value="tidak"> Tidak
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda mengonsumsi obat-obatan tertentu dalam waktu dekat?</p>
                    <div class="w-full flex items-center">
                        <label class="flex items-center">
                            <input class="mr-2" type="radio" id="obat-ya" name="obat" value="ya"> Ya
                        </label>
                        <label class="flex items-center ml-8">
                            <input class="mr-2" type="radio" id="obat-tidak" name="obat" value="tidak"> Tidak
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda memiliki penyakit jantung atau gangguan kesehatan serius lainnya?</p>
                    <div class="w-full flex items-center">
                        <label class="flex items-center">
                            <input class="mr-2" type="radio" id="jantung-ya" name="jantung" value="ya"> Ya
                        </label>
                        <label class="flex items-center ml-8">
                            <input class="mr-2" type="radio" id="jantung-tidak" name="jantung" value="tidak"> Tidak
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda sedang hamil atau menyusui?</p>
                    <div class="w-full flex items-center">
                        <label class="flex items-center">
                            <input class="mr-2" type="radio" id="hamil-ya" name="hamil" value="ya"> Ya
                        </label>
                        <label class="flex items-center ml-8">
                            <input class="mr-2" type="radio" id="hamil-tidak" name="hamil" value="tidak"> Tidak
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda pernah terpapar HIV/AIDS, Hepatitis B, atau Hepatitis C?</p>
                    <div class="w-full flex items-center">
                        <label class="flex items-center">
                            <input class="mr-2" type="radio" id="hiv-ya" name="hiv" value="ya"> Ya
                        </label>
                        <label class="flex items-center ml-8">
                            <input class="mr-2" type="radio" id="hiv-tidak" name="hiv" value="tidak"> Tidak
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" onclick="document.getElementById('kuisionerModal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                <button type="submit" onclick="cekKuisioner(event)" class="bg-red-700 text-white px-4 py-2 rounded">Kirim</button>

            </div>
        </form>
        <script>
           function cekKuisioner(event) {
                event.preventDefault(); // Mencegah form terkirim otomatis

                let sehat = document.querySelector('input[name="sehat"]:checked');
                let obat = document.querySelector('input[name="obat"]:checked');
                let jantung = document.querySelector('input[name="jantung"]:checked');
                let hamil = document.querySelector('input[name="hamil"]:checked');
                let hiv = document.querySelector('input[name="hiv"]:checked');

                // Validasi apakah semua pertanyaan sudah dijawab
                if (!sehat || !obat || !jantung || !hamil || !hiv) {
                    alert("Harap isi semua pertanyaan kuisioner.");
                    return;
                }

                let status = "lolos"; // Default lolos
                if (
                    sehat.value === "ya" ||
                    obat.value === "ya" ||
                    jantung.value === "ya" ||
                    hamil.value === "ya" ||
                    hiv.value === "ya"
                ) {
                    status = "tidak_lolos";
                }

                // Simpan status ke localStorage
                localStorage.setItem("kuisionerStatus", status);

                // Sembunyikan modal kuisioner
                document.getElementById("kuisionerModal").classList.add("hidden");

                // Reload halaman utama supaya daftar section bisa diperbarui
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            }

        </script>
        
        
        
    </div>
</div>
