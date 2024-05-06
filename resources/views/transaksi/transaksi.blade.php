@include('sidebar.sidebar')

<link rel="stylesheet" href="{{ asset('css/transaksi/transaksi.css') }}">

<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Transaksi</h1>
    <p>
        <a href="/dashboard">
            <i class="fas fa-chart-line pe-1"></i>
            Dashboard /
        </a>
        <a href="/dashboard/transaksi">Transaksi</a>
    </p>
</div>

<section>

    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Daftar Barang</p>
        </div>
        <div class="flex justify-end mb-4">
            <input type="text" id="searchInput" placeholder="Cari kode/nama barang"
                class="py-2 pl-3 pr-16 border border-gray-300 rounded-md" autocomplete="off">
        </div>
        <div class="overflow-y-auto mt-4 h-[25vh]">
            <table id="list-item" class="table-auto w-full border-separate border-spacing-1 text-center align-middle">
                <thead>
                    <tr class="text-lg">
                        <th class="bg-slate-100 p-4 font-semibold w-[8%]">#</th>
                        <th class="bg-slate-100 p-4 font-semibold">Nama Item</th>
                        <th class="bg-slate-100 p-4 font-semibold">Harga</th>
                        <th class="bg-slate-100 p-4 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>
                                <form action="{{ route('prosestransaksi.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="transaksi_id" value="{{ $nextKode }}">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-3 rounded">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noMatchMessage" class="mt-12 hidden text-center text-red-500">Barang tidak tersedia</div>
        </div>
    </div>


    <div class="bg-white w-full px-14 py-8 mb-14">
        <div class="flex justify-between items-center">
            <p class="text-xl font-medium text-blue-500">Transaksi</p>
        </div>

        <div class="overflow-x-auto mt-8">
            <p>
                <span class="font-medium">ID Transaksi : </span>
                <span>{{ $nextKode }}</span>
            </p>
            <p>
                <span class="font-medium">Waktu, Tanggal : </span>
                <span>{{ $currentDate }}</span>
            </p>
            <table class="mt-4 table-auto w-full border-separate border-spacing-1 text-center align-middle">
                <thead id="bottom">
                    <tr class="text-lg">
                        <th class="bg-slate-100 p-4 font-semibold">Nama Item</th>
                        <th class="bg-slate-100 p-4 font-semibold">Harga</th>
                        <th class="bg-slate-100 p-4 font-semibold">Jumlah</th>
                        <th class="bg-slate-100 p-4 font-semibold">Total Harga</th>
                        <th class="bg-slate-100 p-4 font-semibold w-44">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prosesTransaksi as $trx)
                        <tr class="text-lg">
                            <td class="p-4 font-normal">{{ $trx->nama_item }}</td>
                            <td class="p-4 font-normal">{{ $trx->harga }}</td>
                            <td class="p-4 font-normal" contenteditable="true" id="jumlah_{{ $trx->id }}">
                                {{ $trx->jumlah }}
                            </td>
                            <td class="p-4 font-normal" id="total_{{ $trx->id }}">
                                {{ $trx->jumlah * $trx->harga }}
                            </td>
                            <td class="p-4 font-normal">
                                <div class="flex justify-center gap-3">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-3 rounded"
                                        onclick="updateJumlah({{ $trx->id }})">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                    <form action="{{ route('proses-transaksi.destroy', $trx->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-3 rounded">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <div class="flex items-center">
                            <td class="p-4 text-lg text-right" colspan="3">Total Harga Semua : </td>
                            <td class="p-4 text-lg">{{ $total }}</td>
                            <td>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-8 rounded"
                                    onclick="bayar()">Bayar</button>
                            </td>
                        </div>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal" id="addForm">
    <div class="form-add">
        <div class="flex justify-between items-center">
            <p class="text-blue-500 font-medium text-lg">Konfirmasi Pembayaran</p>
            <button class="close-btn" onclick="closeForm()">&times;</button>
        </div>
        <form action="{{ route('transaksi.store') }}" class="mt-8 flex flex-col" method="POST">
            @csrf
            <label for="nama">ID Transaksi : <span>{{ $nextKode }}</span></label>
            <label for="waktu">Waktu, Tanggal : <span>{{ $currentDate }}</span></label>
            <label for="">Total Belanja : <span>{{ $total }}</span></label>

            <div class="flex flex-col">
                <label for="nama" class="mt-3">Nama Pembeli : </label>
                <input type="text" name="nama" required autocomplete="off"
                    class="py-2 pl-2 pr-20 border border-blue-200 rounded-sm my-3">
            </div>

            <label for="">Metode Pembayaran : </label>
            <select name="metode_pembayaran" id="metode_pembayaran" onchange="setPaymentAmount()"
                class="mt-3 p-2 border border-gray-300 rounded-md" required>
                <option selected disabled value="">Pilih Metode Pembayaran</option>
                <option value="Tunai">Tunai</option>
                <option value="QRIS">QRIS</option>
                <option value="Transfer Bank">Transfer Bank</option>
            </select>

            <div class="flex justify-between gap-4 mt-3">
                <div class="flex flex-col w-full">
                    <label for="nama">Bayar : </label>
                    <input type="number" name="bayar" id="bayar" required autocomplete="off"
                        class="p-2 border border-blue-200 rounded-sm my-3">
                </div>
                <div class="flex flex-col w-full">
                    <label for="">Kembali : </label>
                    <input type="text" name="kembali" id="kembali" readonly
                        class="p-2 border border-blue-200 rounded-sm bg-[#a8a5a52a] my-3">
                </div>
            </div>
            <div class="text-end">
                <button type="submit" id="tombolKirim"
                    class="w-2/6 items-end mt-4 p-2 border-2 text-white bg-gray-500 hover:bg-gray-700 rounded-xl duration-300 ease-in-out">Tambah</button>
            </div>
        </form>
    </div>
</div>

@if (session('store'))
    <div class="success px-8 drop-shadow-lg" id="success" style="display: block;">
        <div class="add-acc">
            <p class="text-green-500 font-medium text-2xl"><i class="fa-solid fa-check text-green-500"></i> Success
                Created New Transaction!! </p>
            <p class="text-black-500 font-medium text-base mt-2">Transaksi baru berhasil ditambahkan!</p>
            <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden mt-4">
                <div id="progressBar" class="h-full bg-green-500"></div>
            </div>
        </div>
    </div>
@endif



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function bayar() {
        document.getElementById("addForm").style.display = "flex";
    }

    function closeForm() {
        document.getElementById("addForm").style.display = "none";
    }

    if ('{{ session('scrollToBottom') }}') {
        window.location.hash = 'bottom';
    }

    function updateJumlah(id) {
        var jumlah = $('#jumlah_' + id).text().trim();
        var harga = parseFloat($('#harga_' + id).text().trim());
        var total = jumlah * harga; // Hitung total

        // Kirim permintaan Ajax untuk menyimpan perubahan jumlah ke server
        $.ajax({
            url: '{{ route('update.jumlah') }}',
            method: 'POST',
            data: {
                id: id,
                jumlah: jumlah
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 10);
                } else {
                    // alert('Gagal memperbarui jumlah: ' + response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Terjadi kesalahan saat menyimpan perubahan jumlah.');
            }
        });
    }

    function hitungKembali() {
        var total = parseFloat('{{ $total }}');
        var bayar = parseFloat(document.getElementById('bayar').value);
        var tombolKirim = document.getElementById('tombolKirim');

        if (!isNaN(total) && !isNaN(bayar)) {
            var kembali = bayar - total;
            var kembaliFormatted = kembali.toFixed(2).replace(/\.?0+$/, '');
            document.getElementById('kembali').value = kembaliFormatted;

            if (bayar >= total) {
                tombolKirim.disabled = false;
                tombolKirim.classList.remove('hover:bg-gray-700', 'bg-gray-500');
                tombolKirim.classList.add('bg-blue-500', 'hover:bg-blue-700');
            } else {
                tombolKirim.disabled = true;
                tombolKirim.classList.add('hover:bg-gray-700', 'bg-gray-500');
                tombolKirim.classList.remove('bg-blue-500', 'hover:bg-blue-700');
            }
        } else {
            document.getElementById('kembali').value = '';
            tombolKirim.disabled = true;
        }
    }

    document.getElementById('bayar').addEventListener('input', hitungKembali);


    function setPaymentAmount() {
        var total = parseFloat('{{ $total }}');
        var metodePembayaran = document.getElementById('metode_pembayaran').value;
        var bayar = document.getElementById('bayar');

        if (metodePembayaran === 'QRIS' || metodePembayaran === 'Transfer Bank') {
            bayar.value = total;
            hitungKembali();
            bayar.setAttribute('readonly', true);
            bayar.classList.add('bg-[#a8a5a52a]');
        } else {
            bayar.value = '';
            bayar.classList.remove('bg-[#a8a5a52a]')
            bayar.removeAttribute('readonly');
        }
    }

    document.getElementById('metode_pembayaran').addEventListener('change', setPaymentAmount);


    setTimeout(function() {
        var addFormModal = document.getElementById("success");
        addFormModal.style.display = "none";
    }, 2500);

    // Function to update progress bar every second
    var progressBar = document.getElementById("progressBar");
    var totalTime = 2500;
    var currentTime = 0;

    var intervalId = setInterval(function() {
        currentTime += 22;
        var progress = (currentTime / totalTime) * 100;
        progressBar.style.width = progress + "%";
        if (currentTime >= totalTime) {
            clearInterval(intervalId);
        }
    }, 20);


    const search = document.getElementById('searchInput');
    search.addEventListener('input', () => {
        const searchValue = search.value.toLowerCase();

        const rows = document.querySelectorAll('#list-item tbody tr');
        let matchFound = false;

        rows.forEach(function(row) {
            const kodeBarang = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
            const namaBarang = row.querySelector('td:nth-child(2)').innerText.toLowerCase();

            if (kodeBarang.includes(searchValue) || namaBarang.includes(searchValue)) {
                row.style.display = '';
                matchFound = true;
            } else if (searchValue.length > 0) {
                row.style.display = 'none';
            } else {
                row.style.display = '';
            }

        });

        const noMatchMessage = document.getElementById('noMatchMessage');
        if (!matchFound) {
            noMatchMessage.style.display = 'block';
        } else {
            noMatchMessage.style.display = 'none';
        }
    });
</script>
