<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{ asset('images/logo-pt.png') }}" type="image/png">
  <title>@yield('title')</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-screen">

  <div class="flex h-screen">

    <!-- Sidebar -->
    <div id="sidebar" class="w-60 h-full shadow-md flex flex-col">
      <!-- Header Sidebar dengan tulisan & ikon -->
      <div class="h-16 bg-green-500 text-white flex items-center justify-between font-bold px-4 shadow-lg">
        <span class="self-center text-lg font-semibold sidebar-text whitespace-nowrap dark:text-white">Inventori Barang</span>
        <button id="toggleBtn" aria-label="Toggle Sidebar" title="Toggle Sidebar" class="p-2 focus:outline-none hover:bg-gray-500 cursor-pointer">
          <!-- Open Icon-->
          <svg id="hamburgerIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Close Icon -->
          <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" hidden viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Menu List Sidebar -->
      <div class="space-y-2 font-medium flex-1 overflow-auto">
        <ul>
          <li class="p-2 hover:bg-gray-100 cursor-pointer">
            <a href="/admin/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-layout-dashboard" viewBox="0 0 24 24">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 3a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2zm10 -4a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 -8a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2z" />
              </svg>
              <span class="ms-3 sidebar-text">Dashboard</span>
            </a>
          </li>

          <li class="p-2 cursor-pointer">
            <button id="toggleBarang1" class="flex items-center w-full text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group focus:outline-none p-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-table-row">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                <path d="M9 3l-6 6" />
                <path d="M14 3l-7 7" />
                <path d="M19 3l-7 7" />
                <path d="M21 6l-4 4" />
                <path d="M3 10h18" />
                <path d="M10 10v11" />
              </svg>
              </svg>
              <span class="ms-3 flex-1 text-left sidebar-text">Data Barang</span>
              <svg id="arrowIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-auto transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
              </svg>
            </button>
            <ul id="submenuBarang1" class="hidden pl-8 mt-2 space-y-1 text-sm text-gray-700 dark:text-gray-300">
              <li class="p-1 hover:text-green-600 cursor-pointer">
                <a href="/admin/electrical" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bolt">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11" />
                  </svg>
                  <span class="ms-3 sidebar-text">Electrical Part</span>
                </a>
              </li>

              <li class="p-1 hover:text-green-600 cursor-pointer">
                <a href="/admin/instrument" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M6 4v4" />
                    <path d="M6 12v8" />
                    <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M12 4v10" />
                    <path d="M12 18v2" />
                    <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M18 4v1" />
                    <path d="M18 9v11" />
                  </svg>
                  <span class="ms-3 sidebar-text">Instrument Part</span>
                </a>
              </li>

              <li class="p-1 hover:text-green-600 cursor-pointer">
                <a href="/admin/tools" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-tool">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" />
                  </svg>
                  <span class="ms-3 sidebar-text">Tools Part</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="p-2 cursor-pointer">
            <button id="toggleBarang" class="flex items-center w-full text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group focus:outline-none p-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-pencil" viewBox="0 0 24 24">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z" />
              </svg>
              <span class="ms-3 flex-1 text-left sidebar-text">Kelola Barang</span>
              <svg id="arrowIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-auto transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
              </svg>
            </button>

            <ul id="submenuBarang" class="hidden pl-8 mt-2 space-y-1 text-sm text-gray-700 dark:text-gray-300">
              <li class="p-1 hover:text-green-600 cursor-pointer">
                <a href="/admin/masuk" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-library-plus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                    <path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
                    <path d="M11 10h6" />
                    <path d="M14 7v6" />
                  </svg>
                  <span class="ms-3 sidebar-text">Barang Masuk</span>
                </a>
              </li>
              <li class="p-1 hover:text-green-600 cursor-pointer">
                <a href="/admin/keluar" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-library-minus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                    <path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
                    <path d="M11 10h6" />
                  </svg>
                  <span class="ms-3 sidebar-text">Barang Keluar</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="p-2 hover:bg-gray-100 cursor-pointer">
            <a href="/admin/restok" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M12.5 17h-6.5v-14h-2" />
                <path d="M6 5l14 1l-.86 6.017m-2.64 .983h-10.5" />
                <path d="M16 19h6" />
                <path d="M19 16v6" />
              </svg>
              <span class="ms-3 sidebar-text">Restok Barang</span>
            </a>
          </li>

          <li class="p-2 hover:bg-gray-100 cursor-pointer">
            <a href="/admin/laporan" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                <path d="M9 12h6" />
                <path d="M9 16h6" />
              </svg>
              <span class="ms-3 sidebar-text">Laporan</span>
            </a>
          </li>

        </ul>
      </div>
    </div>

    <!-- Main content area -->
    <div class="flex flex-col flex-1 overflow-auto">
      <!-- Navbar -->
      <div class="font-sans font-bold h-16 bg-green-500 text-white flex items-center justify-between px-5 shrink-0">
        <!-- Kiri: Logo + Nama -->
        <a href="/admin/dashboard" class="flex items-center">
          <img src="/images/logo-pt.png" class="h-8 me-3" alt="FlowBite Logo" />
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
            PT Multi Engineering Perkasa
          </span>
        </a>

        <!-- Kanan: Avatar -->
        <div x-data="{ open: false }" class="relative">
          <!-- Avatar Button -->
          <div
            @click="open = !open"
            class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full cursor-pointer hover:ring-2 hover:ring-white">
            <svg
              class="absolute w-12 h-12 text-gray-400 -left-1"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path
                fill-rule="evenodd"
                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                clip-rule="evenodd">
              </path>
            </svg>
          </div>

          <!-- Dropdown Menu -->
          <div
            x-show="open"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            style="display: none;">
            <div class="py-1" role="none">
              <a href="/profil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                Profil
              </a>
              <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                Keluar
              </a>
            </div>
          </div>
        </div>
      </div> <!-- Penutup div navbar -->

      <!-- Content -->
      <div class="flex-1 bg-gray-50 p-5 overflow-auto">
        @yield('mainContent')
      </div>
    </div> <!-- Penutup div flex-col -->
  </div> <!-- Penutup div flex h-screen -->
</body>

</html>