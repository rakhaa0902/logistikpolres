<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Barang Logistik</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; font-size: 14px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>POLRES LOGISTIK</h2>
        <p>Laporan Data Inventaris Barang</p>
        <p>Tanggal: {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $index => $barang)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kategori }}</td>
                <td>{{ $barang->jumlah }} {{ $barang->satuan }}</td>
                <td>{{ $barang->kondisi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>