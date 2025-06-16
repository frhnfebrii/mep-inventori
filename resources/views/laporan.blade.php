@extends('layouts.app')

@section('title', 'Laporan Data Barang')

@section('mainContent')
<div class="container mx-auto p-4 bg-white">
    <h1 class="text-2xl font-semibold mb-4">Laporan Stok Barang</h1>

    {{-- Filter Dropdown --}}
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4 flex flex-wrap gap-4 items-center">
        <div>
        <label for="month" class="block mb-2 font-medium">Filter Bulan:</label>
        <select name="month" id="month" class="border p-2 rounded" onchange="this.form.submit()">
            <option value="this_month" {{ $selectedMonth === 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
            <option value="last_month" {{ $selectedMonth === 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
            @for ($i = 2; $i <= 6; $i++)
                @php
                    $date = \Carbon\Carbon::now()->subMonthsNoOverflow($i);
                    $value = $date->format('Y-m');
                    $label = $date->isoFormat('MMMM YYYY');
                @endphp
                <option value="{{ $value }}" {{ $selectedMonth === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endfor
        </select>
        </div>
        <div>
            <label for="category" class="block mb-1 font-medium">Filter Kategori:</label>
            <select name="category" id="category" class="border p-2 rounded" onchange="this.form.submit()">
                <option value="all" {{ $selectedCategory === 'all' ? 'selected' : '' }}>Semua Kategori</option>
                <option value="Instrument" {{ $selectedCategory === 'Instrument' ? 'selected' : '' }}>Instrument</option>
                <option value="Tools" {{ $selectedCategory === 'Tools' ? 'selected' : '' }}>Tools</option>
                <option value="Electrical" {{ $selectedCategory === 'Electrical' ? 'selected' : '' }}>Electrical</option>
            </select>
        </div>

    </form>

    <p class="mb-4">Periode: <strong>{{ $startDate }}</strong> s/d <strong>{{ $endDate }}</strong></p>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table id="myTable" class="min-w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Part Number</th>
                    <th class="px-4 py-2 border">Brand</th>
                    <th class="px-4 py-2 border">Stok Awal</th>
                    <th class="px-4 py-2 border">Barang Masuk</th>
                    <th class="px-4 py-2 border">Barang Keluar</th>
                    <th class="px-4 py-2 border">Stok Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $index => $item)
                    <tr class="text-center hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $item['kategori'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['description'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['part_number'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['brand'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['stok_awal'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['barang_masuk'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['barang_keluar'] }}</td>
                        <td class="px-4 py-2 border">{{ $item['stok_akhir'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#myTable').DataTable({
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            search: "Cari:",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(filter dari _MAX_ total data)"
        },
        initComplete: function () {
            // Custom Length Menu
            const select = $('#myTable_length select');
            const parent = $('#myTable_length');
            parent.html(`
                <div class="flex items-center gap-2 ">
                    <span>Tampilkan</span>
                </div>
            `);
            parent.find('div').append(select.addClass('border rounded px-2 py-1'));
            parent.find('div').append(`<span>data per halaman</span>`);

            // Custom Search Box
            const searchInput = $('#myTable_filter input');
            searchInput.addClass('border rounded px-3 py-1 ml-2');
            $('#myTable_filter label').addClass('flex items-center gap-2');

            // Gabungkan Length + Search ke baris atas
            $('#myTable_wrapper .dataTables_length, #myTable_wrapper .dataTables_filter')
                .wrapAll('<div class="flex flex-wrap justify-between items-center mb-4 gap-4"></div>');

            // Custom info + pagination (baris bawah)
            const info = $('#myTable_info').addClass('text-sm text-gray-600');
            const paginate = $('#myTable_paginate').addClass('flex items-center gap-1');
            paginate.find('a').addClass('px-3 py-1 border rounded hover:bg-blue-100 transition');

            // Buat container baru untuk info + pagination
            const bottomFlex = $('<div class="flex justify-between items-center mt-4"></div>');
            bottomFlex.append(info).append(paginate);
            $('#myTable_wrapper').append(bottomFlex);

            // Reset styling setiap kali table redraw
            $('#myTable').on('draw.dt', function () {
                $('#myTable_paginate a')
                    .removeClass()
                    .addClass('px-3 py-1 border rounded hover:bg-blue-100 transition');
            });
        }
    });
});

</script>
@endsection