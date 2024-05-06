<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction #{{ $transaksi->transaksi_id }}</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 30px;
        }

        .title {
            text-align: center;
            line-height: 0.6px;
        }

        .title .text-title {
            font-size: 30px;
            font-weight: normal;
            text-transform: uppercase;
        }

        table tr th,
        table tr td {
            font-weight: normal;
            text-align: center;
            text-transform: uppercase;
        }

        table {
            margin-top: 10px;
            width: 100%;
        }

        .print {
            margin-top: 25px;
        }

        .print p {
            font-size: 14px;
        }

        .info {
            width: 100%;
            line-height: 0.6px;
        }

        .info p {
            text-transform: uppercase;
        }

        .dashed-line {
            border-top: 1px dashed black;
        }

        .penutup {
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="title">
        <h1 class="text-title">Vandraa Store</h1>
        <p>Jl. Slamet Riyadi No. 9999</p>
        <p>No. Telp 0011 - 0022 - 003344</p>
    </div>
    <div class="print">
        <div class="info">
            <p>ORDER #{{ $transaksi->transaksi_id }} FOR {{ $transaksi->nama }}</p>
            <p>{{ \Carbon\Carbon::parse($transaksi->created_at)->setTimezone('Asia/Jakarta')->format('j F Y, H:i') }}
            </p>
            <p><span>Payment Method :</span> {{ $transaksi->metode_pembayaran }}</p>
        </div>


        <div>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">
                            <hr class="dashed-line">
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 25rem;">Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <hr class="dashed-line">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $detail)
                        <tr>
                            <td style="padding-top: 10px; padding-bottom: 10px;">{{ $detail->nama_item }}</td>
                            <td style="padding-top: 10px; padding-bottom: 10px;">{{ $detail->jumlah }}</td>
                            <td style="padding-top: 10px; padding-bottom: 10px;">{{ $detail->harga }}</td>
                            <td style="padding-top: 10px; padding-bottom: 10px;">{{ $detail->harga * $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4">
                            <hr class="dashed-line">
                        </th>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; padding-top: 10px; padding-bottom: 10px;">Total :</td>
                        <td style="padding-top: 10px; padding-bottom: 10px;">{{ $total }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; padding-top: 10px; padding-bottom: 10px;">Payment :</td>
                        <td style="padding-top: 10px; padding-bottom: 10px;">{{ $transaksi->bayar }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; padding-top: 10px; padding-bottom: 10px;">Change :</td>
                        <td style="padding-top: 10px; padding-bottom: 10px;">{{ $transaksi->bayar - $total }}</td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <hr class="dashed-line">
                        </th>
                    </tr>
                </tbody>
            </table>
            <div class="penutup">
                <p>Thank you for shopping at Vandraa Store!</p>
            </div>
        </div>
    </div>
</body>

</html>
