@include('sidebar.sidebar')

<link rel="stylesheet" href="{{ asset('css/barang/barang.css') }}">

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Barang</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/barang">Barang</a>
    </p>
</div>


<section>

    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Data Barang</p>

        </div>

        <div class="mt-14 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <p>Search : </p>
                <input type="text" id="search" autocomplete="off" placeholder="Search..." class="border border-gray-300 rounded-3xl px-3 py-2">
            </div>
            <div>
                <button onclick="openForm()"
                    class="py-2 px-4 rounded-3xl border-2 border-green-700 text-green-700 font-medium hover:bg-green-700 hover:text-white duration-300 ease-in-out">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Barang
                </button>
            </div>
        </div>

        <div class="overflow-x-auto mt-8">

            <table id="barang" class="table-auto w-full border-separate border-spacing-1 text-center align-middle">
                <thead>
                    <tr class="text-lg">
                        <th class="bg-slate-100 p-4 font-semibold">No</th>
                        <th class="bg-slate-100 p-4 font-semibold">Kode Barang</th>
                        <th class="bg-slate-100 p-4 font-semibold">Nama Barang</th>
                        <th class="bg-slate-100 p-4 font-semibold">Kategori</th>
                        <th class="bg-slate-100 p-4 font-semibold">Harga</th>
                        <th class="bg-slate-100 p-4 font-semibold w-72">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $b)
                        <tr class="text-lg">
                            <td class="p-4">{{ $i++ }}</td>
                            <td class="p-4">{{ $b->kode_barang }}</td>
                            <td class="p-4">{{ $b->nama_barang }}</td>
                            <td class="p-4">{{ $b->kategori }}</td>
                            <td class="p-4">{{ $b->harga }}</td>
                            <td class="p-4 flex justify-center text-xl items-center gap-4">
                                <a href="{{ route('barang.edit', $b->id) }}"
                                    class="flex justify-center items-center gap-2 text-base border-2 border-green-500 text-green-500 px-5 py-2 rounded-lg hover:bg-green-500 hover:text-white duration-300 ease-in-out">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <button type="submit" onclick="opendelete({{ $b->id }})"
                                    class="flex justify-center items-center gap-2 text-base border-2 border-red-500 text-red-500 px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white duration-300 ease-in-out">
                                    <i class="fa-solid fa-trash"></i> Delete
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noMatchMessage" class="my-8 hidden text-center text-red-500">Barang tidak tersedia</div>
        </div>

    </div>


</section>


<div class="modal" id="addForm">
    <div class="form-add">
        <div class="flex justify-between items-center">
            <p class="text-blue-500 font-medium text-lg">Tambah Barang</p>
            <button class="close-btn" onclick="closeForm()">&times;</button>
        </div>
        <form action="{{ route('barang.store') }}" class="mt-8 flex flex-col" method="POST">
            @csrf
            <label for="nama" class="mb-5">Kode Barang : </label>
            <input type="text" name="kode_barang" value="{{ $nextKode }}" readonly required autocomplete="off"
                class="p-2 border border-blue-200 rounded-sm bg-gray-200">
            <label for="nama_barang" class="mb-5 mt-4">Nama Barang : </label>
            <input type="text" name="nama_barang" required autocomplete="off"
                class="p-2 border border-blue-200 rounded-sm">
            <label for="kategori" class="mb-5 mt-4">Kategori : </label>
            <select name="kategori" id="kategori" class="p-2 border border-gray-300 rounded-md" required>
                <option selected disabled value="">Pilih Kategori</option>
                @foreach ($kategori as $ka)
                    <option value="{{ $ka->nama_kategori }}">{{ $ka->nama_kategori }}</option>
                @endforeach
            </select>
            <label for="harga" class="mb-5 mt-4">Harga : </label>
            <input type="text" name="harga" required autocomplete="off"
                class="p-2 border border-blue-200 rounded-sm">
            <div class="text-end">
                <button type="submit"
                    class="w-2/6 items-end mt-4 p-2 border-2 border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white duration-300 ease-in-out">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="delete">
    <div class="form-add">
        <div class="flex justify-between items-center">
            <p class="text-red-500 font-medium text-2xl">Delete Item</p>
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

@if (session('add'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i class="fa-solid fa-check text-green-500"></i> Success
                Created New Item!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Barang baru berhasil ditambahkan!</p>
            <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                <div id="progressBar" class="h-full bg-green-500"></div>
            </div>
        </div>
    </div>
@endif

@if (session('update'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i class="fa-solid fa-check text-green-500"></i> Success
                Update Item!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Barang berhasil diperbarui!</p>
            <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                <div id="progressBar" class="h-full bg-green-500"></div>
            </div>
        </div>
    </div>
@endif

@if (session('delete'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i class="fa-solid fa-check text-green-500"></i> Success
                Delete Item!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Barang berhasil dihapus!</p>
            <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                <div id="progressBar" class="h-full bg-green-500"></div>
            </div>
        </div>
    </div>
@endif

<script src="{{ asset('js/barang/barang.js') }}"></script>

