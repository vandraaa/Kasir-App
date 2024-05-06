@include('sidebar.sidebar')

<style>
    section {
        margin-left: 280px;
        margin-right: 20px;
        margin-top: 35px;
    }
</style>

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Account</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/account">Account / </a>
        <a href="#">Edit</a>
    </p>
</div>

<section>
    <div class="bg-white w-full px-14 py-8 mb-14">
        <p class="text-xl font-medium text-blue-500">Edit Account</p>
        <form id="editForm" class="mt-8 flex flex-col" method="POST" action="{{ route('account.update', $accounts->id) }}">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <label for="nama" class="mb-5">Nama : </label>
                <input type="text" name="nama" autocomplete="off" value="{{ $accounts->nama }}"
                    class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
            </div>
            <div class="flex flex-col mt-5">
                <label for="email" class="mb-5">Email : </label>
                <input type="text" name="email" autocomplete="off" value="{{ $accounts->email }}"
                    class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
            </div>
            <div class="flex flex-col mt-5">
                <label for="username" class="mb-5">Username : </label>
                <input type="text" name="username" autocomplete="off" value="{{ $accounts->username }}"
                    class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
            </div>
            <div class="flex flex-col mt-5">
                <label for="password" class="mb-5">Password : </label>
                <input type="text" name="password" autocomplete="off" value="{{ $accounts->password }}"
                    class="py-2 pl-2 px-16 border border-blue-200 rounded-sm">
            </div>
            <div class="flex flex-col mt-5">
                <label for="role" class="block mb-5">Role :</label>
                <input value="{{ $accounts->role }}" readonly
                    class="py-2 pl-2 px-16 border border-blue-200 rounded-sm bg-gray-200"></input>
                <p class="mt-2 text-sm text-red-500 opacity-65">Role can't be changed</p>
            </div>
            <div class="text-end">
                <button type="submit"
                    class="w-[15%] items-end mt-4 p-2 border-2 border-blue-500 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white duration-300 ease-in-out">Simpan</button>
            </div>
        </form>
    </div>
</section>
