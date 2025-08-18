@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="mb-0">Laporan KDUM Peserta Didik</h4>
                <div class="mt-4">
                    {{-- Tombol untuk mencetak laporan ke PDF --}}
                    <a href="{{ route('kdum.laporan.cetak') }}" target="_blank" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Cetak ke PDF
                    </a>
                </div>
            </div>

            <div class="card-body" style="overflow-x:auto;">
                <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                    style="width: 100%">
                    {{-- Header tabel --}}
                    <thead style="background-color: #e9f5ff;">
                        <tr>
                            <th rowspan="2" scope="col" class="px-6 py-3 border border-gray-300">No</th>
                            <th rowspan="2" scope="col" class="px-6 py-3 border border-gray-300">NIS</th>
                            <th rowspan="2" scope="col" class="px-6 py-3 border border-gray-300">Nama Siswa</th>
                            <th rowspan="2" scope="col" class="px-6 py-3 border border-gray-300">Kelas</th>
                            {{-- Kolom untuk daftar kompetensi yang dinamis --}}
                            <th colspan="{{ $kompetensiList->count() }}" scope="col"
                                class="px-6 py-3 border border-gray-300 text-center">Nilai KDUM</th>
                        </tr>
                        <tr>
                            {{-- Menampilkan nama kompetensi sebagai sub-kolom --}}
                            @foreach ($kompetensiList as $index => $kompetensi)
                            <th scope="col" class="px-6 py-3 border border-gray-300 text-center">Nilai {{ $index + 1 }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Menggunakan @forelse untuk perulangan data siswa. Jika tidak ada data, tampilkan pesan. --}}
                        @forelse ($siswas as $index => $siswa)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white border border-gray-300">
                                {{ $index + 1 }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $siswa->nis }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $siswa->nama_siswa }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $siswa->kelas->nama_kelas ?? 'N/A' }}
                            </td>
                            {{-- Memeriksa apakah siswa memiliki data KDUM --}}
                            @if ($siswa->kdums->isNotEmpty())
                            @php
                            $kdum = $siswa->kdums->first();
                            $nilaiKompetensi = [];
                            // Mengumpulkan nilai kompetensi ke dalam array asosiatif
                            foreach ($kdum->details as $detail) {
                            if (isset($detail->kompetensi) && isset($detail->nilai)) {
                            $nilaiKompetensi[$detail->kompetensi->id] = $detail->nilai->abjad;
                            }
                            }
                            @endphp
                            {{-- Menampilkan nilai berdasarkan kompetensi --}}
                            @foreach ($kompetensiList as $kompetensi)
                            <td class="px-6 py-4 text-center border border-gray-300">{{
                                $nilaiKompetensi[$kompetensi->id] ?? '-' }}</td>
                            @endforeach
                            @else
                            {{-- Jika tidak ada data KDUM, tampilkan tanda '-' --}}
                            <td colspan="{{ $kompetensiList->count() }}"
                                class="px-6 py-4 text-center border border-gray-300">-</td>
                            @endif
                        </tr>
                        @empty
                        {{-- Jika tidak ada data siswa sama sekali --}}
                        <tr>
                            <td colspan="{{ 4 + $kompetensiList->count() }}"
                                class="px-6 py-4 text-center border border-gray-300">
                                Tidak ada data siswa yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
