<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Stok Barang</h2>
    <p>Periode: <strong>{{ $startDate }}</strong> s/d <strong>{{ $endDate }}</strong></p>
    <p>Kategori: <strong>{{ $selectedCategory }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Description</th>
                <th>Part Number</th>
                <th>Brand</th>
                <th>Stok Awal</th>
                <th>Barang Masuk</th>
                <th>Barang Keluar</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $item['part_number'] }}</td>
                    <td>{{ $item['brand'] }}</td>
                    <td>{{ $item['stok_awal'] }}</td>
                    <td>{{ $item['barang_masuk'] }}</td>
                    <td>{{ $item['barang_keluar'] }}</td>
                    <td>{{ $item['stok_akhir'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
