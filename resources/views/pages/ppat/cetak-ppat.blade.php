@extends('pages.report-layout.main')
@section('surat')
    <style>
        .container {
            margin-left: 5%;
            margin-right: 5%;
            margin-bottom: 10px;
            padding: 20px;
            border: 2px solid black;
        }
    </style>

    <div class="container">
        <button type="button" onclick="window.print()" class="btn">&nbsp;Print</button>
        <h4>Nama Layanan :{{ $ppat->layanan->nama }} | {{ $ppat->nomor_pengajuan }}
            |{{ $ppat->layanan->jenisPermohonan->nama }}</h4>
        <p>Pihak Pertama : {{ $ppat->nama_pihak_pertama }}</p>
        <p>Pihak Kedua : {{ $ppat->nama_pihak_kedua }}</p>
        <p>Alamat Asset : {{ $ppat->alamat_asset_termohon }}</p>
    </div>


    <div class="table-print">

        <table class="table table-bordered d-print-table" width="100%" border="2"
            style="border-collapse: collapse; border: 2px solid black;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Berkas</th>
                    <th>Jenis File</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($lampiran); $i++)
                    @php
                        $string_array = explode('/', $lampiran[$i]);
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $string_array[2] }}</td>
                        <td>PDF</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="table-print">
        <h5>Biaya Layanan</h5>
        <table class="table table-bordered d-print-table" width="100%" border="2"
            style="border-collapse: collapse; border: 2px solid black;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Berkas</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_biaya_layanan = 0;
                @endphp
                @foreach ($biayalayanan as $item)
                    @php
                        $total_biaya_layanan += $item->harga;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->layanan->nama }}</td>
                        <td>{{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">Total :</td>
                    <td>{{ 'Rp ' . number_format($total_biaya_layanan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table-print">
        <h5>Biaya Tambahan</h5>
        <table class="table table-bordered d-print-table" width="100%" border="2"
            style="border-collapse: collapse; border: 2px solid black;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Berkas</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_biaya_tambahan = 0;
                @endphp
                @foreach ($biayaTambahan as $tambahan)
                    @php
                        $total_biaya_tambahan += $tambahan->nominal;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tambahan->nama_biaya }}</td>
                        <td>{{ 'Rp ' . number_format($tambahan->nominal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">Total :</td>
                    <td>{{ 'Rp ' . number_format($total_biaya_tambahan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection