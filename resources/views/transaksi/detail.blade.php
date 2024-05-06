@include('sidebar.sidebar')

<link rel="stylesheet" href="{{ asset('css/transaksi/detail.css') }}">

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between details-center">
    <h1 class="font-medium text-3xl">Detail Transaksi</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/history">Riwayat Transaksi / </a>
        <a href="#">Detail Transaksi</a>
    </p>
</div>

<section>

    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Detail Transaksi</p>
            <a href="{{ route('print', ['id' => $transaksi->transaksi_id]) }}" target="_blank"
                class="text-base border-2 px-5 py-2 rounded-lg bg-green-500 text-white duration-300 ease-in-out">
                <i class="fa-solid fa-print pe-2"></i>
                Print
            </a>
        </div>

        <div class="print">
            <div class="mt-8 flex flex-col gap-1">
                <p><span class="font-semibold">ID TRANSAKSI :</span> {{ $transaksi->transaksi_id }}</p>
                <p><span class="font-semibold">Waktu, Tanggal :</span> {{ \Carbon\Carbon::parse($transaksi->created_at)->setTimezone('Asia/Jakarta')->format('H:i, j F Y') }}</p>
                <p><span class="font-semibold">Nama Pembeli :</span> {{ $transaksi->nama }}</p>
                <p><span class="font-semibold">Metode Pembayaran :</span> {{ $transaksi->metode_pembayaran }}</p>
            </div>


            <div class="overflow-x-auto mt-8">
                <table class="table-auto w-full border-separate border-spacing-1 text-center align-middle">
                    <thead>
                        <tr class="text-lg">
                            <th class="bg-slate-100 p-4 font-semibold">Nama Item</th>
                            <th class="bg-slate-100 p-4 font-semibold">Harga</th>
                            <th class="bg-slate-100 p-4 font-semibold">Jumlah</th>
                            <th class="bg-slate-100 p-4 font-semibold">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $detail)
                            <tr class="text-lg">
                                <td class="p-4">{{ $detail->nama_item }}</td>
                                <td class="p-4">{{ $detail->harga }}</td>
                                <td class="p-4">{{ $detail->jumlah }}</td>
                                <td class="p-4">{{ $total_harga = $detail->harga * $detail->jumlah }}</td>
                            </tr>
                        @endforeach
                        <tr class="text-lg">
                            <td class="p-4 text-right" colspan="3">Total Harga Semua : </td>
                            <td class="p-4">{{ $total }}</td>
                        </tr>
                        <tr class="text-lg">
                            <td class="p-4 text-right" colspan="3">Bayar : </td>
                            <td class="p-4">{{ $transaksi->bayar }}</td>
                        </tr>
                        <tr class="text-lg">
                            <td class="p-4 text-right" colspan="3">Kembali : </td>
                            <td class="p-4">{{ $transaksi->bayar - $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
