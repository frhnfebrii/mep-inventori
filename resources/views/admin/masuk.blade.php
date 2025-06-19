@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('mainContent')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Barang Masuk</h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Tombol Tambah Data -->
    <button onclick="toggleModal('addModal')" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Tambah Barang Masuk</button>

    <div class="bg-white px-4 py-4 border-t-4 border-green-500">    
        <!-- Table Data -->
        <table id="myTable" class="min-w-full border border-gray-200 display">
            <thead> 
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border min-w-[40px] max-w-[60px] text-center">No</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Part Number</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($riwayat as $item)
                <tr>
                    <td class="px-4 py  -2 border text-center">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal }}</td>
                    <td class="px-4 py-2 border">
                        @if($item->electrical_part_id) Electrical
                        @elseif($item->tools_part_id) Tools
                        @elseif($item->instrument_part_id) Instrument
                        @endif
                    </td>
                    <td class="px-4 py-2 border">
                        @if($item->electrical_part_id) {{ $item->electricalPart->description }}
                        @elseif($item->tools_part_id) {{ $item->toolsPart->description }}
                        @elseif($item->instrument_part_id) {{ $item->instrumentPart->description }}
                        @endif
                    </td>
                    <td class="px-4 py-2 border">
                        @if($item->electrical_part_id) {{ $item->electricalPart->part_number }}
                        @elseif($item->tools_part_id) {{ $item->toolsPart->part_number }}
                        @elseif($item->instrument_part_id) {{ $item->instrumentPart->part_number }}
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $item->quantity }} {{ $item->unit }}</td>
                    <td class="px-4 py-2 border w-36">
                        <button onclick='openEditModal(@json($item))' class="text-blue-500">Edit</button>
                        <form action="{{ route('masuk.destroy', $item->id) }}" method="POST" class="inline">
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
        <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">Tambah Barang Masuk</h2>
                <form action="{{ route('masuk.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="block mb-2">Kategori</label>
                        <select id="addKategori" name="kategori_part" class="w-full mb-3 border rounded p-2" required>
                            <option value="">-- Pilih --</option>
                            <option value="electrical">Electrical</option>
                            <option value="tools">Tools</option>
                            <option value="instrument">Instrument</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="block mb-2">Pilih Part</label>
                        <select name="electrical_part_id" id="addElectricalPart" class="w-full mb-3 border rounded p-2 hidden" required>
                            <option value="">-- Pilih Electrical Part --</option>
                            @foreach($electricalParts as $part)
                            <option value="{{ $part->id }}" data-unit="{{ $part->unit }}">
                                {{ $part->description }} ({{ $part->part_number }})
                            </option>
                            @endforeach
                        </select>
                        <select name="tools_part_id" id="addToolsPart" class="w-full mb-3 border rounded p-2 hidden" required>
                            <option value="">-- Pilih Tools Part --</option>
                            @foreach($toolsParts as $part)
                            <option value="{{ $part->id }}" data-unit="{{ $part->unit }}">
                                {{ $part->description }} ({{ $part->part_number }})
                            </option>
                            @endforeach
                        </select>
                        <select name="instrument_part_id" id="addInstrumentPart" class="w-full mb-3 border rounded p-2 hidden" required>
                            <option value="">-- Pilih Instrument Part --</option>
                            @foreach($instrumentParts as $part)
                            <option value="{{ $part->id }}" data-unit="{{ $part->unit }}">
                                {{ $part->description }} ({{ $part->part_number }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="block">Quantity</label>
                        <input type="number" name="quantity" class="w-full border p-2 rounded" required>
                    </div>
                    <div class="mb-2">
                        <label class="block">Satuan</label>
                        <input type="text" name="unit" id="addUnit" class="w-full border p-2 rounded bg-gray-100" readonly>
                    </div>
                    <div class="mb-2">
                        <label class="block">Date</label>
                        <input type="date" name="tanggal" class="w-full border p-2 rounded" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="toggleModal('addModal')" class="bg-gray-400 text-white px-3 py-1 rounded mr-2">Batal</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Edit Data Barang</h2>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label class="block mb-2">Kategori</label>
                        <select id="editKategori" name="kategori_part" class="w-full mb-3 border rounded p-2" required>
                            <option value="electrical">Electrical</option>
                            <option value="tools">Tools</option>
                            <option value="instrument">Instrument</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="block mb-2">Pilih Part</label>
                        <select name="electrical_part_id" id="editElectricalPart" class="w-full mb-3 border rounded p-2" required>
                            @foreach($electricalParts as $part)
                            <option value="{{ $part->id }}" data-unit="{{ $part->unit }}">
                                {{ $part->description }} ({{ $part->part_number }})
                            </option>
                            @endforeach
                        </select>
                        <select name="tools_part_id" id="editToolsPart" class="w-full mb-3 border rounded p-2 hidden" required>
                            @foreach($toolsParts as $part)
                            <option value="{{ $part->id }}" data-unit="{{ $part->unit }}">
                                {{ $part->description }} ({{ $part->part_number }})
                            </option>
                            @endforeach
                        </select>
                        <select name="instrument_part_id" id="editInstrumentPart" class="w-full mb-3 border rounded p-2 hidden" required>
                            @foreach($instrumentParts as $part)
                            <option value="{{ $part->id }}" data-unit="{{ $part->unit }}">
                                {{ $part->description }} ({{ $part->part_number }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Quantity</label>
                        <input type="number" name="quantity" id="editQuantity" class="w-full border p-2 rounded" required>
                    </div>
                    <div class="mb-2">
                        <label class="block">Satuan</label>
                        <input type="text" name="unit" id="editUnit" class="w-full border p-2 rounded bg-gray-100" readonly>
                    </div>
                    <div class="mb-2">
                        <label class="block">Date</label>
                        <input type="date" name="tanggal" id="editTanggal" class="w-full border p-2 rounded" required>   
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

    // Fungsi untuk membuka modal edit dan isi datanya
    function openEditModal(item) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');

        // Set action form
        form.action = `/masuk/${item.id}`;

        // Set nilai form
        document.getElementById('editQuantity').value = item.quantity;
        document.getElementById('editTanggal').value = item.tanggal;
        
        // Set kategori dan part yang sesuai
        if (item.electrical_part_id) {
            document.getElementById('editKategori').value = 'electrical';
            document.getElementById('editElectricalPart').value = item.electrical_part_id;
            document.getElementById('editElectricalPart').classList.remove('hidden');
            document.getElementById('editToolsPart').classList.add('hidden');
            document.getElementById('editInstrumentPart').classList.add('hidden');
            
            const selectedOption = document.querySelector(`#editElectricalPart option[value="${item.electrical_part_id}"]`);
            if (selectedOption) {
                document.getElementById('editUnit').value = selectedOption.getAttribute('data-unit');
            }
        } else if (item.tools_part_id) {
            document.getElementById('editKategori').value = 'tools';
            document.getElementById('editToolsPart').value = item.tools_part_id;
            document.getElementById('editElectricalPart').classList.add('hidden');
            document.getElementById('editToolsPart').classList.remove('hidden');
            document.getElementById('editInstrumentPart').classList.add('hidden');
            
            const selectedOption = document.querySelector(`#editToolsPart option[value="${item.tools_part_id}"]`);
            if (selectedOption) {
                document.getElementById('editUnit').value = selectedOption.getAttribute('data-unit');
            }
        } else if (item.instrument_part_id) {
            document.getElementById('editKategori').value = 'instrument';
            document.getElementById('editInstrumentPart').value = item.instrument_part_id;
            document.getElementById('editElectricalPart').classList.add('hidden');
            document.getElementById('editToolsPart').classList.add('hidden');
            document.getElementById('editInstrumentPart').classList.remove('hidden');
            
            const selectedOption = document.querySelector(`#editInstrumentPart option[value="${item.instrument_part_id}"]`);
            if (selectedOption) {
                document.getElementById('editUnit').value = selectedOption.getAttribute('data-unit');
            }
        }

        // Tampilkan modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Tutup modal edit
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Filter parts berdasarkan kategori (modal tambah)
    document.getElementById('addKategori').addEventListener('change', function() {
        const kategori = this.value;
        
        // Sembunyikan semua select part
        document.getElementById('addElectricalPart').classList.add('hidden');
        document.getElementById('addToolsPart').classList.add('hidden');
        document.getElementById('addInstrumentPart').classList.add('hidden');
        
        // Reset unit
        document.getElementById('addUnit').value = '';
        
        // Tampilkan select yang sesuai
        if (kategori === 'electrical') {
            document.getElementById('addElectricalPart').classList.remove('hidden');
            document.getElementById('addElectricalPart').required = true;
            document.getElementById('addToolsPart').required = false;
            document.getElementById('addInstrumentPart').required = false;
        } else if (kategori === 'tools') {
            document.getElementById('addToolsPart').classList.remove('hidden');
            document.getElementById('addElectricalPart').required = false;
            document.getElementById('addToolsPart').required = true;
            document.getElementById('addInstrumentPart').required = false;
        } else if (kategori === 'instrument') {
            document.getElementById('addInstrumentPart').classList.remove('hidden');
            document.getElementById('addElectricalPart').required = false;
            document.getElementById('addToolsPart').required = false;
            document.getElementById('addInstrumentPart').required = true;
        }
    });

    // Auto-update unit ketika part dipilih (modal tambah)
    document.addEventListener('DOMContentLoaded', function() {
        // Untuk modal tambah
        document.getElementById('addElectricalPart').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('addUnit').value = selectedOption.getAttribute('data-unit');
        });
        
        document.getElementById('addToolsPart').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('addUnit').value = selectedOption.getAttribute('data-unit');
        });
        
        document.getElementById('addInstrumentPart').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('addUnit').value = selectedOption.getAttribute('data-unit');
        });

        // Untuk modal edit
        document.getElementById('editKategori').addEventListener('change', function() {
            const kategori = this.value;
            
            // Sembunyikan semua select part
            document.getElementById('editElectricalPart').classList.add('hidden');
            document.getElementById('editToolsPart').classList.add('hidden');
            document.getElementById('editInstrumentPart').classList.add('hidden');
            
            // Reset unit
            document.getElementById('editUnit').value = '';
            
            // Tampilkan select yang sesuai
            if (kategori === 'electrical') {
                document.getElementById('editElectricalPart').classList.remove('hidden');
            } else if (kategori === 'tools') {
                document.getElementById('editToolsPart').classList.remove('hidden');
            } else if (kategori === 'instrument') {
                document.getElementById('editInstrumentPart').classList.remove('hidden');
            }
        });
        
        document.getElementById('editElectricalPart').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('editUnit').value = selectedOption.getAttribute('data-unit');
        });
        
        document.getElementById('editToolsPart').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('editUnit').value = selectedOption.getAttribute('data-unit');
        });
        
        document.getElementById('editInstrumentPart').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('editUnit').value = selectedOption.getAttribute('data-unit');
        });
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