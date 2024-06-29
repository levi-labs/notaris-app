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

                        @if (session()->has('success'))
                            <div class="alert alert-success mt-4">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-warning mt-4">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if ($ppat->status_layanan == 1)
                            <a href="{{ route('ppat.index') }}" class="btn btn-secondary mt-4">Kembali</a>
                        @elseif ($ppat->status_layanan == 2)
                            <a href="{{ route('ppat.index2') }}" class="btn btn-secondary mt-4">Kembali</a>
                        @elseif ($ppat->status_layanan == 3)
                            <a href="{{ route('ppat.index3') }}" class="btn btn-secondary mt-4">Kembali</a>
                        @elseif ($ppat->status_layanan == 4)
                            <a href="{{ route('ppat.index4') }}" class="btn btn-secondary mt-4">Kembali</a>
                        @endif
                    </div>

                    <div class="card-body table-border-style">
                        @if ($ppat->status_layanan == 2)
                            <div class="alert alert-info">
                                <h6>
                                    <i class="fa fa-info-circle"></i> INFO
                                </h6>
                                <ol>
                                    <li>Silahkan melakukan pembayaran beserta melakukan
                                        verifikasi
                                        data pengajuan
                                        ditempat/kantor.</li>

                                    <li>Setelah Verifikasi data pengajuan, dan melakukan pembayaran dikantor, silahkan
                                        menunggu
                                        proses verifikasi berkas (estimasi 14 hari).</li>

                                    <li>Daftar Biaya Layanan terdapat di bagian bawah halaman.</li>
                                    <li>Terimakasih</li>
                                </ol>
                            </div>
                        @elseif ($ppat->status_layanan == 4)
                            <div class="alert alert-info">
                                <h6>
                                    <i class="fa fa-info-circle"></i> INFO
                                </h6>
                                <ol>
                                    <li>Pengajuan ini sudah diverifikasi</li>
                                    <li>Silahkan mengambil berkas pengajuan dikantor & melakukan sisa pembayaran.</li>
                                    <li>Sisa pembayaran dapat dilihat pada bagian daftar biaya tambahan</li>
                                    <li>Terimakasih</li>
                                </ol>
                            </div>
                        @endif




                        <div class="row">

                            <div class="col-md-5">
                                <div class="card">
                                    <img class="img-fluid card-img-top"
                                        src="{{ asset('assets/images/slider/img-slide-1.jpg') }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Detail Pengajuan</h5>
                                        <table class="table table-hover">
                                            <div class="table-body">
                                                <tr>
                                                    <td>Layanan :</td>
                                                    <td>{{ $ppat->layanan->nama }} | {{ $ppat->nomor_pengajuan }}</td>
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
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="card-title mt-4 mb-2">Biaya Tambahan</h5>
                                            </div>
                                            @if ($ppat->status_layanan == 2 || $ppat->status_layanan == 3)
                                                <div class="col-md-4 text-right pr-3">
                                                    <button type="button" class="btn btn-icon btn-outline-dark"
                                                        id="verify"><i class="feather icon-plus"></i></button>
                                                </div>
                                            @endif

                                        </div>


                                        <hr>
                                        @if (count($biayaTambahan) > 0)
                                            <table class="table table-hover">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Nama Biaya</th>
                                                        <th>Nominal</th>
                                                        @if ($ppat->status_layanan == 2 || $ppat->status_layanan == 3)
                                                            <th>Hapus</th>
                                                        @else
                                                            <th></th>
                                                        @endif

                                                    </tr>
                                                </thead>
                                                @php

                                                    $nominal = 0;
                                                @endphp
                                                <tbody class="table-body text-center">
                                                    @foreach ($biayaTambahan as $tambahan)
                                                        @php

                                                            $nominal += $tambahan->nominal;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $tambahan->nama_biaya }}</td>
                                                            <td>{{ 'Rp ' . number_format($tambahan->nominal, 0, ',', '.') }}
                                                            </td>
                                                            <td>
                                                                @if ($ppat->status_layanan == 2 || $ppat->status_layanan == 3)
                                                                    <a
                                                                        href="{{ route('biaya-tambahan.destroy', $tambahan->id) }}"><i
                                                                            class="fas fa-trash text-danger"></i></a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="2">Total : </td>
                                                        <td>{{ 'Rp ' . number_format($nominal, 0, ',', '.') }}</td>
                                                    </tr>
                                                    @if ($ppat->status_layanan == 3)
                                                        <tr>
                                                            <td colspan="2"></td>

                                                            <td class="text-right">
                                                                <a href="{{ route('ppat.pembayaran-tambahan', $ppat->id) }}"
                                                                    class="btn btn-icon btn-outline-success"><i
                                                                        class="feather icon-check"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                </tbody>

                                            </table>
                                        @else
                                            <p class="text-center">Tidak ada biaya tambahan</p>
                                        @endif

                                        @if ($ppat->status_layanan == 1)
                                            <a href="{{ route('ppat.confirm', $ppat->id) }}"
                                                class="btn btn-primary">Proses</a>
                                        @elseif ($ppat->status_layanan == 2)
                                            <a href="{{ route('ppat.verifikasi', $ppat->id) }}"
                                                class="btn btn-primary">Verifikasi</a>
                                            <a href="{{ route('ppat.reject', $ppat->id) }}"
                                                class="btn btn-danger">Reject</a>
                                            {{-- <button type="button" class="btn btn-primary" id="verify">Biaya
                                                Tambahan</button> --}}
                                        @elseif ($ppat->status_layanan == 3)
                                            <a href="{{ route('ppat.finish', $ppat->id) }}"
                                                class="btn btn-primary">Selesai</a>
                                            <a href="{{ route('ppat.reject', $ppat->id) }}"
                                                class="btn btn-danger">Reject</a>
                                            {{-- <button type="button" class="btn btn-primary" id="verify">Biaya
                                                Tambahan</button> --}}
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
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
                    <style>
                        .btn-arsipkan {
                            background-color: rgb(96, 136, 255) !important;
                            border-color: rgb(101, 107, 237) !important;
                            color: white !important;
                            display: inline-block !important;
                            width: 90% !important;

                        }
                    </style>
                    @if ($ppat->status_layanan == 4)
                        <div class="text-center">
                            <a href="{{ route('arsip-ppat.create', $ppat->id) }}"
                                class="btn btn-arsipkan my-2 mx-1 text-center">Arsipkan</a>
                        </div>
                    @endif


                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Biaya Layanan</h4>
                        @php
                            $transaksi = \App\Models\TransaksiBiayaPermohonan::where('ppat_id', $ppat->id)->first();

                        @endphp
                        @if ($transaksi->count() > 0 && $transaksi->status == 'lunas')
                            <button class="btn btn-primary float-right disabled">Sudah Lunas</button>
                        @elseif ($transaksi->count() > 0 && $transaksi->status == 'belum lunas')
                            <a href="{{ route('ppat.pembayaran', $ppat->id) }}"
                                class="btn btn-primary float-right">Bayar</a>
                        @elseif ($transaksi == null)
                            <a href="{{ route('ppat.pembayaran', $ppat->id) }}"
                                class="btn btn-primary float-right">Bayar</a>
                        @endif

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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @include('pages.ppat.biaya-tambahan')
    @endsection
