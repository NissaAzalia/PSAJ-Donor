<div id="kuisionerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3 max-h-[80vh] overflow-y-auto relative">
        <!-- Tombol Close -->
        <button onclick="document.getElementById('kuisionerModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-700 hover:text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h2 class="text-xl font-bold mb-4 text-red-700">Form Kuisioner</h2>
        <form id="kuisionerForm" action="{{ route('simpan.kuisioner') }}" method="POST">
            @csrf 
            <div class="border-t border-gray-300 pt-4">
                <h2 class="text-red-600 font-semibold mb-2">Kondisi Kesehatan</h2>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda merasa dalam kondisi kelelahan?</p>
                    <label class="mr-4"><input type="radio" name="sehat" value="ya"> Ya</label>
                    <label><input type="radio" name="sehat" value="tidak"> Tidak</label>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda mengonsumsi obat-obatan tertentu dalam waktu dekat?</p>
                    <label class="mr-4"><input type="radio" name="obat" value="ya"> Ya</label>
                    <label><input type="radio" name="obat" value="tidak"> Tidak</label>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda memiliki penyakit jantung atau gangguan kesehatan serius lainnya?</p>
                    <label class="mr-4"><input type="radio" name="jantung" value="ya"> Ya</label>
                    <label><input type="radio" name="jantung" value="tidak"> Tidak</label>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda sedang hamil atau menyusui?</p>
                    <label class="mr-4"><input type="radio" name="hamil" value="ya"> Ya</label>
                    <label><input type="radio" name="hamil" value="tidak"> Tidak</label>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700 mb-1">Apakah Anda pernah terpapar HIV/AIDS, Hepatitis B, atau Hepatitis C?</p>
                    <label class="mr-4"><input type="radio" name="hiv" value="ya"> Ya</label>
                    <label><input type="radio" name="hiv" value="tidak"> Tidak</label>
                </div>
            </div>

            <!-- Input Hidden untuk Status -->
            <input type="hidden" name="kuisioner_status" id="kuisioner_status">

            <div class="flex justify-end mt-6">
                <button type="button" onclick="document.getElementById('kuisionerModal').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
                <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded">Kirim</button>
            </div>
        </form>
        <script>
            document.getElementById("kuisionerForm").addEventListener("submit", function(event) {
                event.preventDefault(); 
        
                let status = "lolos";
                const pertanyaan = ["sehat", "obat", "jantung", "hamil", "hiv"];
        
                for (let i = 0; i < pertanyaan.length; i++) {
                    let jawaban = document.querySelector(`input[name="${pertanyaan[i]}"]:checked`);
                    if (jawaban && jawaban.value === "ya") {
                        status = "tidak_lolos";
                        break;
                    }
                }
        
                document.getElementById("kuisioner_status").value = status;
                this.submit(); // Kirim form setelah status diatur
            });
        </script>
        
        <!-- Flash Message Notifikasi -->
        @if(session('success'))
            <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => document.querySelector('.fixed.bottom-4.right-4').remove(), 3000);
            </script>
        @endif
    </div>
</div>
