@extends('layouts.app')

@section('title', 'Dashboard')

@section('mainContent')
<div class="container mx-auto px-2 py-2">
  <div class="bg-white p-6 shadow-xl ring-1 ring-gray-200">
    
    <!-- Judul -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Dashboard</h2>

    <!-- Baris Pertama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
      
      <!-- Electrical Part Card -->
      <div class="bg-white p-6 rounded-xl shadow-md ring-1 ring-gray-100 flex items-center justify-between hover:shadow-lg transition">
        <div class="flex flex-col gap-1 text-gray-700">
          <p class="text-lg font-semibold">Electrical Part</p>
          <p class="text-3xl font-extrabold text-gray-900 leading-none">10</p>
          <p class="text-sm font-medium text-gray-500">Data Barang</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z" />
          </svg>
        </div>
      </div>

      <!-- Informasi 2 -->
      <div class="bg-white p-6 rounded-xl shadow-md ring-1 ring-gray-100 flex items-center justify-between hover:shadow-lg transition">
        <div class="flex flex-col gap-1 text-gray-700">
          <p class="text-lg font-semibold">Instrument Part</p>
          <p class="text-3xl font-extrabold text-gray-900 leading-none">20</p>
          <p class="text-sm font-medium text-gray-500">Data Barang</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center">
           <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
        </div>
      </div>


      <!-- Informasi 3 -->
      <div class="bg-white p-6 rounded-xl shadow-md ring-1 ring-gray-100 flex items-center justify-between hover:shadow-lg transition">
        <div class="flex flex-col gap-1 text-gray-700">
          <p class="text-lg font-semibold">Tools Part</p>
          <p class="text-3xl font-extrabold text-gray-900 leading-none">5</p>
          <p class="text-sm font-medium text-gray-500">Data Barang</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" /></svg>
        </div>
      </div>


    <!-- Baris Kedua -->
    <div class="bg-white p-6 rounded-xl shadow-md ring-1 ring-gray-100 flex items-center justify-between hover:shadow-lg transition">
        <div class="flex flex-col gap-1 text-gray-700">
          <p class="text-lg font-semibold">Barang Masuk</p>
          <p class="text-3xl font-extrabold text-gray-900 leading-none">24</p>
          <p class="text-sm font-medium text-gray-500">Data Barang</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-library-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" /><path d="M11 10h6" /><path d="M14 7v6" /></svg>
          </svg>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-md ring-1 ring-gray-100 flex items-center justify-between hover:shadow-lg transition">
        <div class="flex flex-col gap-1 text-gray-700">
          <p class="text-lg font-semibold">Barang Keluar</p>
          <p class="text-3xl font-extrabold text-gray-900 leading-none">54</p>
          <p class="text-sm font-medium text-gray-500">Data Barang</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-library-minus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" /><path d="M11 10h6" /></svg>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection
