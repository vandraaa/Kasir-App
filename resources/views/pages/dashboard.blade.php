@include('sidebar.sidebar')

<style>
    section {
        margin-left: 280px;
        margin-right: 20px;
        margin-top: 35px;
    }
</style>


<div class="bg-white px-20 py-7 ml-[210px] flex justify-between items-center">
    <h1 class="font-medium text-3xl">Dashboard</h1>
</div>

<section>

    <div id="loggedInMessage" class="bg-green-500 w-full px-14 py-8">
        <div class="flex justify-between items-center text-white">
            @if (session('logged_in'))
                <p>Hallo <span class="font-semibold">{{ session('nama') }}</span>, kamu berhasil login sebagai <span
                        class="font-semibold lowercase">{{ session('role') }}</span></p>
                <button id="hideButton" class="text-white"><i class="fas fa-times"></i></button>
            @endif
        </div>
    </div>

    <div class="mt-8 container flex justify-between gap-8 flex-wrap">
        <div class="flex-1 max-w-[800px] bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex items-center">
                <div class="md:flex-shrink-0 p-4">
                    <i class="fas fa-box text-6xl text-indigo-500 pl-8"></i>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Total Item</div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $countItem }}</p>
                </div>
            </div>
        </div>
        <div class="flex-1 max-w-[800px] bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex items-center">
                <div class="md:flex-shrink-0 p-4">
                    <i class="fas fa-receipt text-6xl text-indigo-500 pl-8"></i>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Total Transaction</div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $countTrx }}</p>
                </div>
            </div>
        </div>
        <div class="flex-1 max-w-[800px] bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex items-center">
                <div class="md:flex-shrink-0 p-4">
                    <i class="fas fa-money-bill-wave text-6xl text-indigo-500 pl-8"></i>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Category Item</div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $countCategory }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 container flex justify-between gap-8 flex-wrap">
        <div class="flex-1 max-w-[800px] bg-white rounded-xl shadow-md overflow-hidden" id="totalSalesCard">
            <div class="md:flex items-center">
                <div class="md:flex-shrink-0 p-4">
                    <i class="fas fa-money-bill-wave text-6xl text-indigo-500 pl-8"></i>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Total Sales</div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $total }}</p>
                </div>
            </div>
        </div>
        <div class="flex-1 max-w-[800px] bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex items-center">
                <div class="md:flex-shrink-0 p-4">
                    <i class="fas fa-cubes text-6xl text-indigo-500 pl-8"></i>
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Items Sold</div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $countItemSold }}</p>
                </div>
            </div>
        </div>
    </div>


</section>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hideButton = document.getElementById("hideButton");
        const loggedInMessage = document.getElementById("loggedInMessage");
        const hideStatus = localStorage.getItem("hideStatus");

        if (hideStatus === "true") {
            loggedInMessage.style.display = "none";
        }

        hideButton.addEventListener("click", function() {
            loggedInMessage.style.display = "none";
            localStorage.setItem("hideStatus", "true");
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const totalElement = document.getElementById('totalSalesCard').querySelector('p');

        // Ambil nilai total dari konten elemen
        let total = totalElement.textContent;

        // Ubah total menjadi angka dan tambahkan pemisah ribuan
        total = parseFloat(total).toLocaleString();

        // Masukkan kembali nilai yang sudah diformat ke dalam konten elemen
        totalElement.textContent = total;
    });
</script>
