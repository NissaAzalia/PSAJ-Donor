@include('components.member-modal', ['anggota' => $anggota])

<x-app-layout>
    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="">
                @if(!$profilLengkap)
                    <!-- Daftar Anggota Section -->
                    <div id="datadiriModal" class="bg-[#B20600] p-6 rounded-lg text-white">
                        <p class="mb-4">Silakan isi Biodata Terlebih dahulu untuk lanjut pendaftaran</p>
                        <button onclick="openDaftarModal()" onclick="document.getElementById('daftarDonorModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Isi Biodata</button>
                    </div>
                @endif

                @if($profilLengkap)
                    <div id="kuisionerSection" class="bg-[#B20600] p-6 rounded-lg text-white">
                @else
                    <div id="kuisionerSection" class="bg-[#B20600] p-6 rounded-lg text-white hidden">
                @endif
                        <p class="mb-4">Sebelum melakukan pendaftaran, harap mengisi kuisioner terlebih dahulu</p>
                        <button onclick="document.getElementById('kuisionerModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Kuisioner</button>
                    </div>

                <!-- Maaf Section -->
                <div id="maafSection" class="bg-[#B20600] p-6 rounded-lg text-white hidden">
                    <p class="mb-4">Maaf, Anda tidak memenuhi syarat untuk mendonorkan darah. Cobalah di lain waktu setelah memenuhi syarat yang diperlukan</p>
                    <button onclick="document.getElementById('kuisionerModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Coba Lagi</button>
                </div>

                <!-- Daftar Donor Section -->
                <div id="daftarDonorSection" class="bg-[#B20600] p-6 rounded-lg text-white hidden ">
                    <p class="mb-4">Selamat! Anda lolos syarat untuk donor darah. Lanjutkan ke pendaftaran</p>
                    <button onclick="document.getElementById('daftarDonorModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Daftar</button>
                </div>

                <!-- Donor lagi Section -->
                <div id="donorLagiSection" class="bg-[#B20600] p-6 rounded-lg text-white hidden">
                    <p class="mb-4"> Jika ingin donor lagi, silakan lanjutkan.</p>
                    <button onclick="document.getElementById('kuisionerModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Donor Lagi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let status = "{{ $anggota->kuisioner_status ?? '' }}".trim();

            if (status === "lolos") {
                showSection("daftarDonorSection");
            } else if (status === "tidak_lolos") {
                showSection("maafSection");
            } else if (status === "ulang") {
                showSection("donorLagiSection");
            }
        });

        function showSection(sectionId) {
            // Sembunyikan semua section dulu
            document.getElementById("kuisionerSection").classList.add("hidden");
            document.getElementById("daftarDonorSection").classList.add("hidden");
            document.getElementById("maafSection").classList.add("hidden");
            document.getElementById("donorLagiSection").classList.add("hidden"); // Tambahkan ini
            // Tampilkan yang sesuai
            document.getElementById(sectionId).classList.remove("hidden");
        }

        function openDaftarModal() {
            document.getElementById('dataDiriModal').classList.remove('hidden');
        }
    </script>



</x-app-layout>
