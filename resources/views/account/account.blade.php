@include('sidebar.sidebar')

<link rel="stylesheet" href="{{ asset('css/account/account.css') }}">

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Account</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/account">Account</a>
    </p>
</div>

<section>
    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Data Account</p>
        </div>

        <div class="mt-14 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <p>Search : </p>
                <input type="text" id="searchInput" placeholder="Search..." class="border border-gray-300 rounded-3xl px-3 py-2" autocomplete="off">
            </div>
            <div>
                <button onclick="addAccount()"
                class="py-2 px-4 rounded-3xl border-2 border-green-700 text-green-700 font-medium hover:bg-green-700 hover:text-white duration-300 ease-in-out">
                <i class="fa-solid fa-plus"></i>
                Tambah Account
            </button>
            </div>
        </div>


        <div class="overflow-x-auto mt-8">
            <table id="list-acc" class="table-auto w-full border-separate border-spacing-1 text-center align-middle">
                <thead>
                    <tr class="text-lg">
                        <th class="bg-slate-100 p-4 font-semibold">No</th>
                        <th class="bg-slate-100 p-4 font-semibold">Nama</th>
                        <th class="bg-slate-100 p-4 font-semibold">Email</th>
                        <th class="bg-slate-100 p-4 font-semibold">Username</th>
                        <th class="bg-slate-100 p-4 font-semibold">Password</th>
                        <th class="bg-slate-100 p-4 font-semibold">Role</th>
                        <th class="bg-slate-100 p-4 font-semibold w-72">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($account as $a)
                        <tr class="text-lg">
                            <td class="p-4 text-sm">{{ $i++ }}</td>
                            <td class="p-4 text-sm">{{ $a->nama }}</td>
                            <td class="p-4 text-sm">{{ $a->email }}</td>
                            <td class="p-4 text-sm">{{ $a->username }}</td>
                            <td class="p-4 text-sm">{{ $a->password }}</td>
                            <td class="p-4 text-sm">{{ $a->role }}</td>
                            <td class="p-4 flex justify-center text-xl items-center gap-4">
                                <a href="{{ route('account.edit', $a->id) }}"
                                    class="flex justify-center items-center gap-2 text-base border-2 border-green-500 text-green-500 px-5 py-2 rounded-lg hover:bg-green-500 hover:text-white duration-300 ease-in-out">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <button type="submit" onclick="opendelete({{ $a->id }})"
                                    class="flex justify-center items-center gap-2 text-base border-2 border-red-500 text-red-500 px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white duration-300 ease-in-out">
                                    <i class="fa-solid fa-trash"></i> Delete
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noMatchMessage" class="my-8 hidden text-center text-red-500">Akun tidak tersedia</div>
        </div>

    </div>


</section>




<div class="modal" id="account">
    <div class="add-acc">
        <div class="flex justify-between items-center">
            <p class="text-blue-500 font-medium text-2xl">Tambah Account</p>
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

<div class="modal" id="delete">
    <div class="add-acc">
        <div class="flex justify-between items-center">
            <p class="text-red-500 font-medium text-2xl">Delete Account</p>
            <button class="close-btn" onclick="closedelete()">&times;</button>
        </div>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <img src="{{ asset('assets/trash.png') }}" alt="Trash Icon" class="color-red-500 mx-auto">
            <button type="submit"
                class="w-[60%] mx-auto flex justify-center items-center gap-2 text-base border-2 border-red-500 text-red-500 px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white duration-300 ease-in-out">
                Delete
            </button>
        </form>
    </div>
</div>

@if (session('showSuccessAdd'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i
                class="fa-solid fa-check text-green-500"></i> Success Created Account!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Akun berhasil dibuat! silahkan
                login ulang untuk menggunakan akun tersebut</p>
                <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                    <div id="progressBar" class="h-full bg-green-500"></div>
                </div>
        </div>
    </div>
@endif

@if (session('showSuccessUpdate'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i
                class="fa-solid fa-check text-green-500"></i> Success Update Account!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Akun berhasil diperbarui!</p>
                <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                    <div id="progressBar" class="h-full bg-green-500"></div>
                </div>
        </div>
    </div>
@endif

@if (session('showSuccessDelete'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i
                class="fa-solid fa-check text-green-500"></i> Success Delete Account!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Akun berhasil dihapus!</p>
                <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                    <div id="progressBar" class="h-full bg-green-500"></div>
                </div>
        </div>
    </div>
@endif

<script src="{{ asset('js/account/account.js') }}"></script>

