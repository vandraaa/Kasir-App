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

    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    {{-- Login --}}
    <div class="w-8/12 bg-white p-8 rounded-lg shadow-md" id="login">
        <h2 class="text-3xl text-center mb-8 font-medium">LOGIN</h2>
        <form method="POST" action="" class="flex flex-col justify-center mx-auto w-7/12">
            @csrf
            <div class="mb-4">
                <label for="username" class="block mb-1">Username or Email :</label>
                <input type="text" required autocomplete="off" placeholder="Masukkan username atau email..." name="username"
                    class="pl-4 pr-44 w-full border border-gray-300 py-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label for="password" required class="block mb-1">Password :</label>
                <input type="password" placeholder="Masukkan password..." name="password"
                    class="pl-4 pr-44 w-full border border-gray-300 py-2 rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit"
                class="w-full bg-blue-500 mx-auto text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
        </form>
        <p class="text-center pt-6">Don't have a account? <a onclick="addAccount()" href="#">Register Here</a>
        </p>
    </div>

    {{-- Register --}}
    <div class="modal" id="account">
        <div class="add-acc">
            <div class="flex justify-between items-center">
                <p class="text-blue-500 font-medium text-2xl">Create Account</p>
                <button class="close-btn" onclick="closeAccount()">&times;</button>
            </div>
            <form action="{{ route('account.store') }}" class="mt-8 flex flex-col" method="POST">
                @csrf
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <label for="nama" class="mb-5">Nama : </label>
                        <input type="text" name="nama" autocomplete="off" required
                            class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="mb-5">Email : </label>
                        <input type="text" name="email" autocomplete="off" required
                            class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
                    </div>
                </div>
                <div class="flex justify-between mt-8">
                    <div class="flex flex-col">
                        <label for="username" class="mb-5">Username : </label>
                        <input type="text" name="username" autocomplete="off" required
                            class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
                    </div>
                    <div class="flex flex-col">
                        <label for="password" class="mb-5">Password : </label>
                        <input type="password" name="password" autocomplete="off" required
                            class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
                    </div>
                </div>
                <label for="role" class="block mb- mt-8">Role :</label>
                <select id="role" name="role" required
                    class="block w-full pl-4 pr-44 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="" selected disabled>Pilih Role</option>
                    <option value="ADMIN" class="bg-blue-100 text-blue-800">ADMIN</option>
                    <option value="KASIR" class="bg-green-100 text-green-800">KASIR</option>
                </select>
                <div class="text-end">
                    <button type="submit"
                        class="w-2/6 items-end mt-4 p-2 border-2 border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white duration-300 ease-in-out">Tambah</button>
                </div>
            </form>
        </div>
    </div>


    @if ($errors->any())
        <div class="modal-error" id="out">
            <div class="error" id="errorNotification">
                <p class="text-red-500 font-medium text-3xl text-center">Login Failed!</p>
                <div class="flex justify-between items-center">
                    <button class="close-btn" onclick="closeNotification()">&times;</button>
                </div>
                <img src="{{ asset('assets/404.png') }}"class="color-red-500 mx-auto">
                <p class=" text-lg text-center w-[70%] mx-auto">Please Check Again Your Account & Password</p>
            </div>
        </div>
    @endif

    @if (session('showSuccessAdd'))
    <div class="modal px-8" id="addForm" style="display: block;">
        <div class="add-acc">
            <p class="text-red-500 font-medium text-3xl text-center">Registration Successfull!!</p>
            <div class="flex justify-between items-center">
                <button class="close-btn" onclick="closeForm()">&times;</button>
            </div>
            <img src="{{ asset('assets/success.png') }}" class="my-8 color-red-500 mx-auto w-[30%]">
            <p class="text-red-500 font-medium text-xl text-center w-[80%] mx-auto">Akun berhasil dibuat! Silahkan login ulang untuk melanjutkan</p>
        </div>
    </div>
@endif

<script src="{{ asset('js/login/login.js') }}"></script>

</body>
</html>
