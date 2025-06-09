@extends('layouts.app')

@section('title', 'Data Barang Electrical Part')

@section('mainContent')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Data Barang Electrical</h1>

    <!-- Tombol Tambah Data -->
    <button onclick="toggleModal('modalTambah')" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Tambah Barang</button>

<div class="bg-white px-4 py-4">    <!-- Table Data -->
    <table id="myTable" class="min-w-full border border-gray-200 display">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Deskripsi</th>
                <th class="px-4 py-2 border">Part Number</th>
                <th class="px-4 py-2 border">Brand</th>
                <th class="px-4 py-2 border">Quantity</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($barangmasuks as $barang)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $barang->description }}</td>
                <td class="px-4 py-2 border">{{ $barang->part_number }}</td>
                <td class="px-4 py-2 border">{{ $barang->brand }}</td>
                <td class="px-4 py-2 border">{{ $barang->quantity }}</td>
                <td class="px-4 py-2 border">
                    <button onclick='openEditModal(@json($barang))' class="text-blue-500">Edit</button>
                    <form action="{{ route('barangmasuks.destroy', $barang->id) }}" method="POST" class="inline">
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
            <form action="{{ route('barangmasuks.store') }}" method="POST">
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
                    <input type="number" name="quantity" class="w-full border p-2 rounded" required>
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
                    <input type="number" name="quantity" id="editQuantity" class="w-full border p-2 rounded">
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
    function openEditModal(barang) {
        document.getElementById('editDescription').value = barang.description;
        document.getElementById('editPartNumber').value = barang.part_number;
        document.getElementById('editBrand').value = barang.brand;
        document.getElementById('editQuantity').value = barang.quantity;

        const form = document.getElementById('editForm');
        form.action = `/barangmasuks/${barang.id}`;

        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('modalEdit').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('modalEdit').classList.add('hidden');
        document.getElementById('modalEdit').classList.remove('flex');
    }

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
            }
        });
    });
</script>
<style>
    /* Container DataTables agar tidak saling menempel */
    .dataTables_wrapper {
        margin-bottom: 2rem;
    }

    /* Jarak antar elemen length dan search */
    .dataTables_length {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    

    .dataTables_filter {
        margin-bottom: 1rem;
    }
    table.dataTable tbody {
        background-color: white !important; /* bg-white */
        color: #1f2937 !important; /* text-gray-800 */
    }

</style>

@endsection
