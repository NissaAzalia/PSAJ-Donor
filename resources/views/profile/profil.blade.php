<x-app-layout>
    <div class="bg-gray-100 flex min-h-screen">
        <x-sidebar />
        <div class="bg-white p-6 rounded-lg shadow-lg w-[900px] mx-8 my-8">
            
            <!-- Cek apakah user sudah mendaftar -->
            @if($anggota)
                <!-- Header Profil -->
                <div class="flex gap-[300px] items-center mb-6">
                    <div class="bg-[#B20600] text-white p-4 h-[90px] w-[400px] rounded-lg">
                        <h2 class="text-xl font-bold">{{ $anggota->nama }}</h2>
                        <p>{{ $anggota->nohp }}</p>
                    </div>
                    <div class="bg-gray-200 p-4 h-[90px] w-[100px] rounded-lg flex items-center justify-center">
                        <img src="{{ asset('image/blood.png') }}" alt="Blood drop icon" class="w-6 mr-2">
                        <span class="text-3xl font-bold">{{ $anggota->golongan_darah }}</span>
                    </div>
                </div>

                <!-- Informasi Pendaftar -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-gray-200 p-4 rounded-lg text-left shadow">
                        <p class="text-gray-600">Total Donor</p>
                        <p class="text-2xl font-bold">{{ $transaksiDarahCount }} kali</p>
                    </div>
                    
                    <div class="bg-gray-200 p-4 rounded-lg text-left shadow">
                        <p class="text-gray-600">Donor Terakhir</p>
                        <p class="text-2xl font-bold">
                            {{ $donorTerakhir ? \Carbon\Carbon::parse($donorTerakhir->tanggal)->format('d M Y') : '-' }}
                        </p>
                    </div>
                    
                    <div class="bg-gray-200 p-4 rounded-lg text-left shadow">
                        <p class="text-gray-600">Donor Kembali</p>
                        <p class="text-2xl font-bold">
                            {{ $donorKembali ? $donorKembali->format('d M Y') : '-' }}
                        </p>
                    </div>
                    
                    <!-- Tabel Riwayat Donor -->
                    <div class=" mt-6 w-[400px] mx-auto bg-gray-200 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Riwayat Donor</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse bg-white shadow-md rounded-lg">
                                <thead class="bg-gray-300 text-gray-700">
                                    <tr>
                                        <th class="p-2 text-left border border-gray-300 w-12">No</th>
                                        <th class="p-2 text-left border border-gray-300 max-w-xs whitespace-nowrap">Tanggal Donor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatDonor as $index => $transaksi)
                                    <tr class="border-t border-gray-300">
                                            <td class="p-3 border border-gray-300">{{ $index + 1 }}</td>
                                            <td class="p-3 border border-gray-300">
                                                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}
                                                <br>
                                                <span class="text-sm text-gray-600">
                                                    Telah melakukan donor darah pada tanggal ini
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center p-3 text-gray-600">Belum ada riwayat donor</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
            @else
                <p class="text-gray-600 text-center text-xl">Anda belum mengisi Data Diri pada dashboard.</p>
            @endif
        </div>
    </div>
</x-app-layout>
