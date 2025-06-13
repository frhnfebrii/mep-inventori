@extends('layouts.app')

@section('title', 'Data Barang Electrical Part')

@section('mainContent')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Data Barang Electrical</h1>

    <!-- Tombol Tambah Data -->
    <button onclick="toggleModal('modalTambah')" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Tambah Barang</button>

<div class="bg-white px-4 py-4 border-t-4 border-green-500">    <!-- Table Data -->
    <table id="myTable" class="min-w-full border border-gray-200 display">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border min-w-[40px] max-w-[60px] text-center">No</th>
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Part Number</th>
                <th class="px-4 py-2 border">Brand</th>
                <th class="px-4 py-2 border">Quantity</th>
                <th class="px-4 py-2 border">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($electricalParts as $part)
            <tr>
                <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $part->description }}</td>
                <td class="px-4 py-2 border">{{ $part->part_number }}</td>
                <td class="px-4 py-2 border w-60">{{ $part->brand }}</td>
                <td class="px-4 py-2 border w-20">{{ $part->quantity }} {{ $part->unit }}</td>
                <td class="px-4 py-2 border w-36">
                    <button onclick='openEditModal(@json($part))' class="text-blue-500">Edit</button>
                    <form action="{{ route('electrical.destroy', $part->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Tambah Barang Masuk</h2>
            <form action="{{ route('electrical.store') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="block">Deskripsi</label>
                    <input type="text" name="description" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-2">
                    <label class="block">Part Number</label>
                    <input type="text" name="part_number" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-2">
                    <label class="block">Brand</label>
                    <input type="text" name="brand" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-2">
                    <label class="block">Quantity</label>
                    <input type="number" name="quantity" id="quantityTambah" min="0" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-2">
                    <label class="block">Satuan</label>
                        <select name="unit" class="w-full border p-2 rounded" required>
                        <option value="pcs">pcs</option>
                        <option value="unit">Unit</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal('modalTambah')" class="bg-gray-400 text-white px-3 py-1 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Data Barang</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label>Deskripsi</label>
                    <input type="text" name="description" id="editDescription" class="w-full border p-2 rounded">
                </div>
                <div class="mb-2">
                    <label>Part Number</label>
                    <input type="text" name="part_number" id="editPartNumber" class="w-full border p-2 rounded">
                </div>
                <div class="mb-2">
                    <label>Brand</label>
                    <input type="text" name="brand" id="editBrand" class="w-full border p-2 rounded">
                </div>
                <div class="mb-2">
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="0" id="editQuantity" class="w-full border p-2 rounded">
                </div>
                <div class="mb-2">
                    <label>Satuan</label>
                    <select name="unit" id="editUnit" class="w-full border p-2 rounded" required>
                        <option value="pcs">pcs</option>
                        <option value="unit">unit</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 px-4 py-2 mr-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    // Toggle modal function
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }

    // Open edit modal with data
    function openEditModal(part) {
        document.getElementById('editDescription').value = part.description;
        document.getElementById('editPartNumber').value = part.part_number;
        document.getElementById('editBrand').value = part.brand;
        document.getElementById('editQuantity').value = part.quantity;
        document.getElementById('editUnit').value = part.unit;

        const form = document.getElementById('editForm');
        form.action = `/electrical/${part.id}`;

        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('modalEdit').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
        document.getElementById('modalEdit').classList.remove('flex');
    }


    const quantityTambah = document.getElementById('quantityTambah');
    quantityTambah.addEventListener('keydown', function(e) {
        if (e.key === '-' || e.key === 'e') e.preventDefault();
    });
    quantityTambah.addEventListener('input', function() {
        if (this.value < 0) this.value = 0;
    });

    // === Cegah input minus di Modal Edit ===
    const quantityEdit = document.getElementById('editQuantity');
    quantityEdit.addEventListener('keydown', function(e) {
        if (e.key === '-' || e.key === 'e') e.preventDefault();
    });
    quantityEdit.addEventListener('input', function() {
        if (this.value < 0) this.value = 0;
    });

    // Inisialisasi DataTables
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
