<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexyLite</title>

    <!-- Font Awesome & Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

    @stack('styles')
</head>

<body class="bg-white-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <div class="w-80 bg-white shadow-md flex flex-col">
            <!-- Logo & Title -->
            <div class="p-4 flex items-center gap-2">
    <img src="/img/logobunga.png" alt="Logo" class="w-20 h-20 rounded-full">
    <h1 class="text-3xl font-bold -ml-2"> Petaluna</h1>
</div>

            

            <!-- Navigation -->
            <ul class="mt-4">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-3 text-gray-600 hover:bg-blue-500 hover:text-white text-xl">
                        <i class="fas fa-chart-line mr-3 text-xl"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/produk"
                        class="flex items-center p-3 text-gray-600 hover:bg-blue-500 hover:text-white text-xl">
                        <i class="fas fa-box mr-3 text-xl"></i> Produk
                    </a>
                </li>
                <li>
                    <a href="/penjualan"
                        class="flex items-center p-3 text-gray-600 hover:bg-blue-500 hover:text-white text-xl">
                        <i class="fas fa-shopping-cart mr-3 text-xl"></i> Pembelian
                    </a>
                </li>
                @if(Auth::user()->role === 'admin')
                    <li>
                        <a href="/users"
                            class="flex items-center p-3 text-gray-600 hover:bg-blue-500 hover:text-white text-xl">
                            <i class="fas fa-user mr-3 text-xl"></i> User
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Top Navbar -->
            <div class="flex justify-end items-center p-4 bg-white shadow-md w-full">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 bg-gray-100 px-4 py-2 rounded-md hover:bg-gray-200">
                        <i class="fas fa-user-circle text-xl text-gray-600"></i>
                        <span>{{ ucfirst(Auth::user()->role) }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md py-2 z-50">
                        <a href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                <!-- Search Bar -->
                <div class="mb-4">
                    <input type="text" placeholder="Search" class="border rounded-lg p-2 w-full">
                </div>

                @yield('content')
            </div>

        </div>

    </div>

</body>

</html>