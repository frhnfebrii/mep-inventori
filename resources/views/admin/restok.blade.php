@extends('layouts.app')

@section('title', 'Restok Barang')

@section('mainContent')
<div class="container mx-auto p-6 bg-white">

    <h1 class="text-2xl font-semibold mb-4">Rekomendasi Restok Barang</h1>

    <!-- Filter dan Papan Info -->
<div class="mb-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
    <!-- Filter Dropdown -->
    <div>
        <label for="rangeFilter" class="block mb-2 font-semibold">Filter Range (A1 - A3)</label>
        <select id="rangeFilter" class="border p-2 rounded w-48">
            <option value="All">Tampilkan Semua</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select>
    </div>

    <!-- Papan Informasi Range -->
    <div class="border-l-4 border-blue-500 pl-4 bg-blue-50 p-4 rounded shadow-sm w-full md:w-2/3">
        <h2 class="font-semibold text-blue-800 mb-2">Interpretasi Range Stok</h2>
        <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
            <li><strong>Rata Rata barang keluar diambil dari keseluruhan data historis barang keluar</strong></li>
            <li><strong>A1:</strong> Stok lebih dari 140% rata-rata barang keluar — <span class="text-green-600 font-medium">Aman</span>.</li>
            <li><strong>A2:</strong> Stok antara 100% – 140% rata-rata barang keluar — <span class="text-yellow-600 font-medium">Pertimbangkan Restok</span>.</li>
            <li><strong>A3:</strong> Stok kurang dari rata-rata barang keluar — <span class="text-red-600 font-medium">Perlu Restok Segera</span>.</li>
        </ul>
    </div>
</div>



    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table id="myTable" class="min-w-full divide-y border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Part Number</th>
                    <th class="border px-4 py-2">Kategori Barang</th>
                    <th class="border px-4 py-2">Rata-Rata Keluar</th>
                    <th class="border px-4 py-2">Stok Saat Ini</th>
                    <th class="border px-4 py-2">Range (A1-A3)</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($data as $category => $items)
                    @foreach ($items as $item)
                        <tr class="item-row" data-range="{{ $item['range'] }}">
                            <td class="border px-4 py-2">{{ $no++ }}</td>
                            <td class="border px-4 py-2">{{ $item['description'] }}</td>
                            <td class="border px-4 py-2">{{ $item['part_number'] }}</td>
                            <td class="border px-4 py-2">{{ $item['kategori_barang'] }}</td>
                            <td class="border px-4 py-2">{{ $item['avg_out'] }}</td>
                            <td class="border px-4 py-2">{{ $item['stok_saat_ini'] }}</td>
                            <td class="border px-4 py-2">{{ $item['range'] }}</td>
                            <td class="border px-4 py-2">{{ $item['status'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- Filter Script -->
<script>
    $(document).ready(function() {
        const table = $('#myTable').DataTable({
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
                    <div class="flex items-center gap-2">
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
            }
        });

        // ✅ Filter Dropdown Custom di luar DataTables
        $('#rangeFilter').on('change', function() {
            const selected = this.value;

            $('.item-row').each(function() {
                const rowRange = $(this).data('range');

                if (selected === 'All' || rowRange === selected) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

@endsection
