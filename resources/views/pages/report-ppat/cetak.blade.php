@extends('pages.report-layout.main')
@section('surat')
    <style>
        .wrap {
            display: flex;
            justify-content: center;
            padding-right: 2%;
            padding-left: 2%;
        }

        .container {

            margin-bottom: 10px;
            padding: 20px;
            border: 2px solid black;
            width: 60%;
        }
    </style>
    {{-- 
    <div class="wrap">
        <div class="container">
            <button type="button" onclick="window.print()" class="btn">&nbsp;Print</button>
            <center>
                <h4>Laporan PPAT</h4>
            </center>
            <h4>Nama Layanan :{{ $ppat->layanan->nama }} | {{ $ppat->nomor_pengajuan }}
                |{{ $ppat->layanan->jenisPermohonan->nama }}</h4>
            <p>Pihak Pertama : {{ $ppat->nama_pihak_pertama }}</p>
            <p>Pihak Kedua : {{ $ppat->nama_pihak_kedua }}</p>
            <p>Alamat Asset : {{ $ppat->alamat_asset_termohon }}</p>
        </div>

    </div> --}}


    <div class="table-print">
        <button type="button" onclick="window.print()" class="btn">&nbsp;Print</button>
        <center>
            <h5>REPORT PPAT | RUMONDA KESUMA LUBIS </h5>
        </center>

        <table class="table table-bordered d-print-table" width="100%" border="2"
            style="border-collapse: collapse; border: 2px solid black;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengaju</th>
                    <th>No Akta</th>
                    <th>No Arsip</th>
                    <th>Layanan</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->no_arsip }}</td>
                    <td>{{ $item->no_akta }}</td>
                    <td>{{ $item->nama_layanan }}</td>
                    <td>{{ $item->nama_jenis }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
