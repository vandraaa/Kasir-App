@include('sidebar.sidebar')

<style>
    section {
        margin-left: 280px;
        margin-right: 20px;
        margin-top: 35px;
    }
</style>

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Barang</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/barang">Barang / </a>
        <a href="#">Edit</a>
    </p>
</div>



<section>
    <div class="bg-white w-full px-14 py-8 mb-14">
        <p class="text-xl font-medium text-blue-500">Edit Barang</p>
        <form id="editForm" class="mt-8 flex flex-col" method="POST" action="{{ route('barang.update', $barang->id) }}">
            @csrf
            @method('PUT')
            <label for="nama" class="mb-5">Kode Barang : </label>
            <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}" readonly required autocomplete="off"
                class="p-2 border border-blue-200 rounded-sm bg-gray-200">
                <p class="mt-2 text-sm text-red-500 opacity-65">Code can't be changed</p>
            <label for="nama_barang" class="mb-5 mt-4">Nama Barang : </label>
            <input type="text" name="nama_barang" required autocomplete="off"
                class="p-2 border border-blue-200 rounded-sm" value="{{ $barang->nama_barang }}">
            <label for="kategori" class="mb-5 mt-4">Kategori : </label>
            <select name="kategori" id="kategori" class="p-2 border border-gray-300 rounded-md" required>
                @foreach ($kategori as $ka)
                    <option value="{{ $ka->nama_kategori }}" {{ $barang->kategori == $ka->nama_kategori ? 'selected' : '' }}>
                        {{ $ka->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <label for="harga" class="mb-5 mt-4">Harga : </label>
            <input type="text" name="harga" required autocomplete="off"
                class="p-2 border border-blue-200 rounded-sm" value="{{$barang->harga}}">
            <div class="text-end">
                <button type="submit"
                    class="w-[15%] items-end mt-4 p-2 border-2 border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white duration-300 ease-in-out">Simpan</button>
            </div>
        </form>
    </div>
</section>
