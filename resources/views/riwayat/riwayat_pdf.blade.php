    <!DOCTYPE html>
<html>
<head>
    <title>Laporan Mutasi Barang</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid black; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 16pt; }
        .header p { margin: 5px 0; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; font-size: 10pt; }
        th { background-color: #f0f0f0; text-align: center; font-weight: bold; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .masuk { color: green; }
        .keluar { color: red; }
    </style>
</head>
<body>

    <div class="header">
        <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 10px;">
            <img src="{{ public_path('logo-polres-logistik.png') }}" alt="Logo Polres Logistik" style="width: 50px; height: 50px; margin-right: 10px;">
            <div style="text-align: center;">
                <h2>POLRES LOGISTIK</h2>
                <p>LAPORAN MUTASI (KELUAR/MASUK) BARANG</p>
            </div>
        </div>
        
        @if($request->start_date && $request->end_date)
            <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($request->start_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($request->end_date)->format('d-m-Y') }}</p>
        @else
            <p><strong>Periode:</strong> Semua Riwayat Transaksi</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Petugas</th>
                <th width="20%">Nama Barang</th>
                <th width="10%">Jenis</th>
                <th width="10%">Jumlah</th>
                <th width="25%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayats as $index => $riwayat)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $riwayat->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $riwayat->user->name ?? 'User Hapus' }}</td>
                <td>
                    {{ $riwayat->barang->nama_barang ?? 'Barang Hapus' }} <br>
                    <small>({{ $riwayat->barang->kode_barang ?? '-' }})</small>
                </td>
                <td class="text-center">
                    @if($riwayat->jenis_transaksi == 'masuk')
                        <span class="masuk">MASUK</span>
                    @else
                        <span class="keluar">KELUAR</span>
                    @endif
                </td>
                <td class="text-center">{{ $riwayat->jumlah }}</td>
                <td>{{ $riwayat->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right;">
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>

</body>
</html> 