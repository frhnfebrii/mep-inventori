@extends('layouts.app')

@section('title', 'Profil')

@section('mainContent')
<div class=" w-full bg-gray-100 flex">
    <!-- KIRI: Profil Icon -->
    <div class="flex flex-col items-center justify-start w-1/3 bg-white pt-20 border-t-4 border-green-500">
        <div class="w-48 h-48 bg-gray-200 rounded-full flex items-center justify-center">
            <svg 
                class="w-32 h-32 text-gray-400" 
                fill="currentColor" 
                viewBox="0 0 20 20" 
                xmlns="http://www.w3.org/2000/svg"
            >
                <path 
                    fill-rule="evenodd" 
                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" 
                    clip-rule="evenodd"
                ></path>
            </svg>
        </div>
    </div>

    <!-- KANAN: Data Diri -->
    <div class="flex flex-col justify-start w-2/3 px-16 bg-gray-50 pt-20">
        <h2 class="text-3xl font-bold mb-8">Profil</h2>
        <div class="space-y-6 text-lg">
            <div>
                <span class="text-gray-600 font-semibold">Nama:</span>
                <span class="ml-2 text-gray-800">Nayla</span>
            </div>
            <div>
                <span class="text-gray-600 font-semibold">Status:</span>
                <span class="ml-2 text-gray-800">Admin</span>
            </div>
            <div>
                <span class="text-gray-600 font-semibold">Email:</span>
                <span class="ml-2 text-gray-800">nayla@example.com</span>
            </div>
            <div>
                <span class="text-gray-600 font-semibold">Password:</span>
                <span class="ml-2 text-gray-800">********</span>
            </div>
        </div>

        <!-- Tombol Edit -->
        <!-- Tombol Edit & Ganti Password -->
<div class="mt-10 flex space-x-4">
    <a href="#" class="inline-block bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
        Edit Profil
    </a>
    <a href="#" class="inline-block bg-green-500 text-white px-6 py-3 rounded hover:bg-yellow-600">
        Ganti Password
    </a>
</div>

    </div>
</div>
@endsection
