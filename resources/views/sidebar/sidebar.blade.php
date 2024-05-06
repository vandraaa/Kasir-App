<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vandraa Store</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css\sidebar\sidebar.css') }}">
</head>

@if (isset($user))
    @if ($user->role == 'KASIR')
        <style>
            #menuSidebar {
                display: none;
            }
        </style>
    @endif
    @if ($user->role == 'ADMIN')
        <style>
            #menuTrx {
                display: none;
            }
        </style>
    @endif
@endif

<body class="bg-gray-100">
    <header>
        <nav class="fixed">
            <div class="bg-white px-10 w-64 h-screen">
                <h1 class="font-semibold text-1xl text-center pt-5">Vandraa Store</h1>
                {{-- Dasboard --}}
                <div class="mt-8">
                    <p class="text-sm font-medium mb-2">Dashboard</p>
                    <a href="/dashboard" class="flex items-center">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fas fa-chart-line pe-4"></i>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </div>
                {{-- Menu --}}
                <div class="mt-8" id="menuSidebar">
                    <p class="text-sm font-medium mb-2">Menu</p>
                    <a href="/dashboard/account" class="flex items-center">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fa-solid fa-user pe-5"></i>
                            <span>Account</span>
                        </div>
                    </a>
                    <a href="/dashboard/kategori" class="flex items-center">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fa-solid fa-bars pe-5"></i>
                            <span>Category</span>
                        </div>
                    </a>
                    <a href="/dashboard/barang" class="flex items-center">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fas fa-box pe-5"></i>
                            <span>Product</span>
                        </div>
                    </a>
                </div>
                {{-- Transaksi --}}
                <div class="mt-8">
                    <p class="text-sm font-medium mb-2">Transaction</p>
                    <a href="/dashboard/transaksi" class="flex items-center" id="menuTrx">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fas fa-wallet pe-4"></i>
                            <span>Transaction</span>
                        </div>
                    </a>
                    <a href="/dashboard/history" class="flex items-center">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fas fa-history pe-4"></i>
                            <span>History</span>
                        </div>
                    </a>
                </div>
                {{-- Logout --}}
                <div class="mt-8">
                    <p class="text-sm font-medium mb-2">Log Out</p>
                    <a href="#logout" onclick="showOut()" class="flex items-center">
                        <div
                            class="w-full flex items-center hover:bg-gray-200 rounded-lg py-2 pl-2 pr-12 transition-colors duration-300">
                            <i class="fa-solid fa-right-from-bracket pe-4"></i>
                            <span>Log Out</span>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
        <nav class="bg-blue-500 h-16 w-full flex justify-between text-white pl-72 pr-10 font-normal items-center">
            @if (session('logged_in'))
                <p>{{ session('nama') }} as <span class="font-semibold">{{ session('role') }}</span></p>
            @endif
            <p>{{ $date->format('l, j F Y') }}</p>
        </nav>
    </header>



    <div class="modalout" id="out">
        <div class="out">
            <div class="flex justify-between items-center">
                <p class="text-red-500 font-medium text-2xl">Are you sure you want to log out?</p>
                <button class="close-btn" onclick="closeout()">&times;</button>
            </div>
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/login-log-out-4549239-3766880.png" class="color-red-500 mx-auto w-[80%]">
            <a href="{{ route('logout') }}" id="logout"
                class="w-[60%] mx-auto flex justify-center items-center gap-2 text-base border-2 border-red-500 text-red-500 px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white duration-300 ease-in-out">
                Yes, Log Out
            </a>
        </div>
    </div>

    <script src="{{ asset('js/sidebar/sidebar.js') }}"></script>

</body>

</html>
