@include('sidebar.sidebar')

<link rel="stylesheet" href="{{ asset('css/kategori/kategori.css') }}">

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Kategori</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/kategori">Kategori</a>
    </p>
</div>

<section>

    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Data Kategori</p>

        </div>

        <div class="mt-14 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <p>Search : </p>
                <input type="text" id="search" autocomplete="off" placeholder="Search..." class="border border-gray-300 rounded-3xl px-3 py-2">
            </div>
            <div class="">
                <button onclick="openForm()"
                class="py-2 px-4 rounded-3xl border-2 border-green-700 text-green-700 font-medium hover:bg-green-700 hover:text-white duration-300 ease-in-out">
                <i class="fa-solid fa-plus"></i>
                Tambah Kategori
            </button>
            </div>
        </div>


        <div class="overflow-x-auto mt-8">
            <table id="table-kategori" class="table-auto w-full border-separate border-spacing-1 text-center align-middle">
                <thead>
                    <tr class="text-lg">
                        <th class="bg-slate-100 p-4 font-semibold">No</th>
                        <th class="bg-slate-100 p-4 font-semibold">Nama Kategori</th>
                        <th class="bg-slate-100 p-4 font-semibold w-72">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $k)
                        <tr class="text-lg">
                            <td class="p-4">{{ $i++ }}</td>
                            <td class="p-4">{{ $k->nama_kategori }}</td>
                            <td class="p-4 flex justify-center text-xl items-center gap-4">
                                <a href="{{ route('kategori.edit', $k->id) }}"
                                    class="flex justify-center items-center gap-2 text-base border-2 border-green-500 text-green-500 px-5 py-2 rounded-lg hover:bg-green-500 hover:text-white duration-300 ease-in-out">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <button type="submit" onclick="opendelete({{ $k->id }})"
                                    class="flex justify-center items-center gap-2 text-base border-2 border-red-500 text-red-500 px-5 py-2 rounded-lg hover:bg-red-500 hover:text-white duration-300 ease-in-out">
                                    <i class="fa-solid fa-trash"></i> Delete
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noMatchMessage" class="my-8 hidden text-center text-red-500">Kategori tidak tersedia</div>
        </div>
    </div>

</section>


<div class="modal" id="addForm">
    <div class="form-add">
        <div class="flex justify-between items-center">
            <p class="text-blue-500 font-medium text-lg">Tambah Kategori</p>
            <button class="close-btn" onclick="closeForm()">&times;</button>
        </div>
        <form action="{{ route('kategori.store') }}" class="mt-8 flex flex-col" method="POST">
            @csrf
            <label for="nama" class="mb-5">Nama Kategori : </label>
            <input type="text" name="nama_kategori" required autocomplete="off" class="p-2 border border-blue-200 rounded-sm">
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
            <p class="text-red-500 font-medium text-2xl">Delete Kategori</p>
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



@if (session('addCategory'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i
                class="fa-solid fa-check text-green-500"></i> Success Created New Category!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Kategori baru berhasil ditambahkan!</p>
                <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                    <div id="progressBar" class="h-full bg-green-500"></div>
                </div>
        </div>
    </div>
@endif

@if (session('updateCategory'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i
                class="fa-solid fa-check text-green-500"></i> Success Update Category!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Kategori berhasil diperbarui!</p>
                <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                    <div id="progressBar" class="h-full bg-green-500"></div>
                </div>
        </div>
    </div>
@endif

@if (session('deleteCategory'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i
                class="fa-solid fa-check text-green-500"></i> Success Delete Category!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Kategori berhasil dihapus!</p>
                <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                    <div id="progressBar" class="h-full bg-green-500"></div>
                </div>
        </div>
    </div>
@endif

<script src="{{ asset('js/kategori/kategori.js') }}"></script>
