@include('sidebar.sidebar')

<style>
    section {
        margin-left: 280px;
        margin-right: 20px;
        margin-top: 35px;
    }
</style>

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Kategori</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/kategori">Kategori / </a>
        <a href="#">Edit</a>
    </p>
</div>

<section>
    <div class="bg-white w-full px-14 py-8 mb-14">
        <p class="text-xl font-medium text-blue-500">Edit Kategori</p>
        <form id="editForm" class="mt-8 flex flex-col" method="POST" action="{{ route('kategori.update', $kategori->id) }}">
            @csrf
            @method('PUT')
            <label for="nama" class="mb-5">Nama Kategori : </label>
            <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" autocomplete="off" class="p-2 border border-blue-200 rounded-sm">
            <div class="text-end">
                <button type="submit"
                    class="w-[15%] items-end mt-4 p-2 border-2 border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white duration-300 ease-in-out">Simpan</button>
            </div>
        </form>
    </div>
</section>


