<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multi Engineering Perkasa</title>
    <link rel="icon" href="{{ asset('images/logo-pt.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-900 font-sans">

    <!-- Header -->
    <header class="bg-white shadow p-4 mb-5">
        <div class="flex justify-between items-center px-5">
            <div class="flex items-center">
                <img src="/images/logo-pt.png" class="h-7 me-4" alt="Logo" />
                <div class="text-lg font-semibold text-gray-800">PT Multi Engineering Perkasa</div>
            </div>
            <div class="flex items-center font-semibold text-md">
                <a href="/logout" class="text-gray-900 hover:underline flex items-center gap-2">
                    Keluar
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M9 12h12l-3 -3" />
                        <path d="M18 15l3 -3" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="px-7 text-md">
        <div class="p-6">
            <!-- Tabs Kategori -->
            <div class="mb-6 flex space-x-4">
                <button class="tab-button bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 shadow" data-target="section-electrical">Electrical</button>
                <button class="tab-button bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 shadow" data-target="section-instrument">Instrument</button>
                <button class="tab-button bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-yellow-700 shadow" data-target="section-tools">Tools</button>
            </div>

            <!-- Electrical Section -->
            <div id="section-electrical" class="category-section">
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden mb-12">
                    <div class="flex items-center justify-between px-6 pt-6">
                        <h2 class="text-lg font-semibold text-gray-700">Data Barang - Electrical</h2>
                        <span class="text-md text-gray-500">Total item: {{ $electrical->count() }}</span>
                    </div>
                    <div class="p-6">
                        <table class="data-table display w-full">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Part Number</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($electrical as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->part_number }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->quantity }} {{ $item->unit }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Instrument Section -->
            <div id="section-instrument" class="category-section hidden">
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden mb-12">
                    <div class="flex items-center justify-between px-6 pt-6">
                        <h2 class="text-lg font-semibold text-gray-700">Data Barang - Instrument</h2>
                        <span class="text-md text-gray-500">Total item: {{ $instrument->count() }}</span>
                    </div>
                    <div class="p-6">
                        <table class="data-table display w-full">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Part Number</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instrument as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->part_number }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->quantity }} {{ $item->unit }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tools Section -->
            <div id="section-tools" class="category-section hidden">
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden mb-12">
                    <div class="flex items-center justify-between px-6 pt-6">
                        <h2 class="text-lg font-semibold text-gray-700">Data Barang - Tools</h2>
                        <span class="text-md text-gray-500">Total item: {{ $tools->count() }}</span>
                    </div>
                    <div class="p-6">
                        <table class="data-table display w-full">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Part Number</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tools as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->part_number }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->quantity }} {{ $item->unit }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Filter Periode -->
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-700">Barang Paling Banyak Keluar</h2>
                <select class="border border-gray-300 rounded-lg px-4 py-2 text-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option>7 Hari Terakhir</option>
                    <option selected>30 Hari Terakhir</option>
                    <option>3 Bulan Terakhir</option>
                </select>
            </div>

            <!-- Barang Paling Banyak Keluar per Kategori -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-lg p-6 rounded-2xl">
                    <h2 class="font-bold text-lg mb-3 text-green-700">Top Keluar - Electrical</h2>
                    <p class="text-md text-gray-500 mb-2">Data 30 hari terakhir</p>
                    <ul class="text-base space-y-2 text-gray-700">
                        @foreach ($topElectrical as $item)
                        <li>{{ $item->electricalPart->description }} - {{ $item->total }} pcs</li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-2xl">
                    <h2 class="font-bold text-lg mb-3 text-blue-700">Top Keluar - Instrument</h2>
                    <p class="text-md text-gray-500 mb-2">Data 30 hari terakhir</p>
                    <ul class="text-base space-y-2 text-gray-700">
                        @foreach ($topInstrument as $item)
                        <li>{{ $item->instrumentPart->description }} - {{ $item->total }} pcs</li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-2xl">
                    <h2 class="font-bold text-lg mb-3 text-yellow-700">Top Keluar - Tools</h2>
                    <p class="text-md text-gray-500 mb-2">Data 30 hari terakhir</p>
                    <ul class="text-base space-y-2 text-gray-700">
                        @foreach ($topTools as $item)
                        <li>{{ $item->toolsPart->description }} - {{ $item->total }} pcs</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(".data-table").DataTable();

            // Handle tab switch
            const tabs = document.querySelectorAll(".tab-button");
            const sections = document.querySelectorAll(".category-section");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    const target = this.getAttribute("data-target");
                    sections.forEach(section => {
                        section.classList.add("hidden");
                    });
                    document.getElementById(target).classList.remove("hidden");
                });
            });
        });
    </script>
</body>

</html>