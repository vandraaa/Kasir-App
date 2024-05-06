@include('sidebar.sidebar')

<link rel="stylesheet" href="{{ asset('css/transaksi/history.css') }}">

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Riwayat Transaksi</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/history">Riwayat Transaksi</a>
    </p>
</div>

<section>

    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Riwayat Transaksi</p>
        </div>
        <div class="flex items-center space-x-4 mt-14">
            <p>Search : </p>
            <input type="text" id="search" autocomplete="off" placeholder="Search..." class="border border-gray-300 rounded-3xl px-3 py-2">
        </div>
        <div class="overflow-x-auto mt-8">
            <table id="history" class="table-auto w-full border-separate border-spacing-1 text-center align-middle">
                <thead>
                    <tr class="text-lg">
                        <th class="bg-slate-100 p-4 font-semibold">No</th>
                        <th class="bg-slate-100 p-4 font-semibold">Id Transaksi</th>
                        <th class="bg-slate-100 p-4 font-semibold">Tanggal</th>
                        <th class="bg-slate-100 p-4 font-semibold">Nama Pembeli</th>
                        <th class="bg-slate-100 p-4 font-semibold">Detail Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->sortByDesc('transaksi_id') as $tr)
                    <tr class="text-lg">
                        <td class="p-4">{{ $i++ }}</td>
                        <td class="p-4">{{ $tr->transaksi_id }}</td>
                        <td class="p-4">{{ \Carbon\Carbon::parse($tr->created_at)->setTimezone('Asia/Jakarta')->format('H:i, j F Y') }}</td>
                        <td class="p-4">{{ $tr->nama }}</td>
                        <td class="p-4">
                            <a href="/detailtransaksi/{{$tr->transaksi_id}}" class="text-blue-500 hover:underline">
                                <i class="fas fa-receipt pe-2"></i>
                                Detail Transaksi
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noMatchMessage" class="my-8 hidden text-center text-red-500">Transaksi tidak tersedia</div>
        </div>
    </div>

</section>

<script src="{{ asset('js/transaksi/history.js') }}"></script>
