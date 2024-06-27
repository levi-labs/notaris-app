@extends('layouts.master')

@section('content')
    <style>
        .more-text {
            max-width: 250px !important;
            white-space: pre-line !important;
        }

        .my-img {
            width: 20% !important;
        }

        .my-button {
            background: none !important;
            border: none;
            cursor: pointer;
        }


        .my-button p {
            margin: 0;
        }
    </style>
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $title }}</h3>
                        @if (session()->has('file'))
                            <div class="alert alert-danger mt-4">
                                {{ session()->get('file') }}
                            </div>
                    </div>
                    @endif
                    <a href="{{ route('ppat.index') }}" class="btn btn-secondary mt-4">Kembali</a>


                    <div class="card-body table-border-style">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <img class="img-fluid card-img-top"
                                        src="{{ asset('assets/images/slider/img-slide-1.jpg') }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Detail Pengajuan</h5>
                                        <table class="table table-hover">
                                            <div class="table-body">
                                                <tr>
                                                    <td>Layanan :</td>
                                                    <td>{{ $ppat->layanan->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Pihak Pertama:</td>
                                                    <td>{{ $ppat->nama_pihak_pertama }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Pihak Kedua:</td>
                                                    <td>{{ $ppat->nama_pihak_kedua }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat Asset Termohon:</td>
                                                    <td class="more-text">{{ $ppat->alamat_asset_termohon }}</td>
                                                </tr>

                                            </div>

                                        </table>


                                        <button class="btn  btn-primary">Prosses</button>
                                        <button class="btn  btn-danger">Reject</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class="my-2">Berkas Terlampir</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover mt-2">
                                        <thead class="text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Layanan Permohonan</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @for ($i = 0; $i < count($lampiran); $i++)
                                                @php
                                                    $berkasLayanan = new \App\Http\Controllers\PpatController();
                                                    $string_array = explode('/', $lampiran[$i]);
                                                    $filename = $lampiran[$i];

                                                @endphp
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td class="more-text">

                                                        {{ $string_array[2] }}
                                                        <div class="badge badge-danger mt-2">
                                                            PDF
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{-- <a href="{{ route('ppat.download', ['filename' => $lampiran[$i]]) }}">
                                                        <img class="my-img"
                                                            src="{{ asset('assets/pdf-image-removebg-preview.png') }}"
                                                            alt="pdf-icon">
                                                        <p>DOWNLOAD</p>
                                                    </a> --}}
                                                        <form action="{{ route('ppat.download') }}" method="POST">
                                                            @csrf <!-- Add this line to include a CSRF token -->
                                                            <input type="hidden" name="filename"
                                                                value="{{ $lampiran[$i] }}">
                                                            <button type="submit" class="my-button">
                                                                <img class="my-img"
                                                                    src="{{ asset('assets/pdf-image-removebg-preview.png') }}"
                                                                    alt="pdf-icon">
                                                                <p>DOWNLOAD</p>
                                                            </button>
                                                        </form>
                                                    </td>

                                                    {{-- <td>
                                                    <a href="{{ route('ppat.show', $item->id) }}"
                                                        class="btn btn-secondary">
                                                        Detail
                                                    </a>
                                                    <a href="{{ route('ppat.edit', $item->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="{{ route('ppat.destroy', $item->id) }}"
                                                        class="btn btn-danger">Hapus</a>
                                                </td> --}}
                                                </tr>
                                            @endfor



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Biaya Layanan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Biaya</th>
                                    <th>Nama Layanan</th>
                                    <th>Nominal/Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biayalayanan as $biaya)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $biaya->nama_biaya }}</td>
                                        <td>{{ $biaya->layanan->nama }}</td>
                                        <td>{{ 'Rp ' . number_format($biaya->harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
