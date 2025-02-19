<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="">
                <!-- Kuisoner Section -->
                <div id="kuisionerSection" class="bg-[#B20600] p-6 rounded-lg text-white">
                    <p class="mb-4">Sebelum melakukan pendaftaran, harap mengisi kuisioner terlebih dahulu</p>
                    <button onclick="document.getElementById('kuisionerModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Kuisioner</button>
                </div>

                <!-- Daftar Section -->
                <div id="daftarSection" class="bg-[#B20600] p-6 rounded-lg text-white hidden">
                    <p class="mb-4">Selamat! Anda lolos syarat untuk donor darah. Lanjutkan ke pendaftaran</p>
                    {{-- <button class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Daftar</button> --}}
                    <button onclick="document.getElementById('daftarModal').classList.remove('hidden')" class="bg-white text-red-700 font-semibold py-2 px-4 rounded">Daftar</button>

                </div>

                <!-- Maaf Section -->
                <div id="maafSection" class="bg-[#B20600] p-6 rounded-lg text-white hidden">
                    <p>Maaf, Anda tidak memenuhi syarat untuk mendonorkan darah. Cobalah di lain waktu setelah memenuhi syarat yang diperlukan</p>
                </div>
            </div>
        </div>
        
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let status = localStorage.getItem("kuisionerStatus");
    
            let daftarSection = document.getElementById("daftarSection");
            let maafSection = document.getElementById("maafSection");
    
            if (status === "lolos") {
                kuisionerSection.classList.add("hidden");
                daftarSection.classList.remove("hidden");
                maafSection.classList.add("hidden");
            } else if (status === "tidak_lolos") {
                kuisionerSection.classList.add("hidden");
                daftarSection.classList.add("hidden");
                maafSection.classList.remove("hidden");
            } else {
                daftarSection.classList.add("hidden");
                maafSection.classList.add("hidden");
            }
        });
    </script>
    
</x-app-layout>
