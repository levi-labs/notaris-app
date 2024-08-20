@extends('layouts.master')
@push('midtrans')
    @once
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key=config('midtrans.clientKey')></script>
    @endonce
@endpush
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

        .btn-arsipkan {
            background-color: rgb(96, 136, 255) !important;
            border-color: rgb(101, 107, 237) !important;
            color: white !important;
            display: inline-block !important;
            width: 90% !important;

        }

        .btn-cetak {
            background-color: rgb(171, 171, 171) !important;
            border-color: rgb(72, 72, 72) !important;
            color: white !important;
            display: inline-block !important;
            width: 90% !important;
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
                        @endif

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
                        @elseif ($ppat->status_layanan == 3)
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
                                                    <td>{{ $ppat->layanan->nama }} | {{ $ppat->nomor_pengajuan }}
                                                    </td>
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
                                                <tr>
                                                    <td>Berkas Terlampir</td>
                                                    @php
                                                        $file = $ppat->file_ppat;

                                                    @endphp
                                                    <td>
                                                        <form action="{{ route('ppat.download') }}" method="POST">
                                                            @csrf <!-- Add this line to include a CSRF token -->
                                                            <input type="hidden" name="filename"
                                                                value="{{ $file }}">
                                                            <button type="submit" class="my-button">
                                                                <img class="my-img"
                                                                    src="{{ asset('assets/pdf-image-removebg-preview.png') }}"
                                                                    alt="pdf-icon">
                                                                <p>DOWNLOAD</p>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                            </div>

                                        </table>
                                        <hr>
                                        @if ($ppat->status_layanan == 1)
                                            @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                <a href="{{ route('ppat.confirm', $ppat->id) }}"
                                                    class="btn btn-primary">Proses</a>
                                                {{-- <a href="{{ route('ppat.reject', $ppat->id) }}" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?') ? true : false">Reject</a> --}}
                                            @endif

                                            <a href="{{ route('ppat.reject', $ppat->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?') ? true : false">Reject</a>
                                        @elseif ($ppat->status_layanan == 2)
                                            @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                <a href="{{ route('ppat.verifikasi', $ppat->id) }}"
                                                    class="btn btn-primary">Verifikasi</a>
                                                <a href="{{ route('ppat.reject', $ppat->id) }}"
                                                    class="btn btn-danger">Reject</a>
                                            @endif

                                            {{-- <button type="button" class="btn btn-primary" id="verify">Biaya
                                                Tambahan</button> --}}
                                        @elseif ($ppat->status_layanan == 3)
                                            @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                <a href="{{ route('ppat.finish', $ppat->id) }}"
                                                    class="btn btn-primary">Selesai</a>
                                                <a href="{{ route('ppat.reject', $ppat->id) }}"
                                                    class="btn btn-danger">Reject</a>
                                            @endif

                                            {{-- <button type="button" class="btn btn-primary" id="verify">Biaya
                                                Tambahan</button> --}}
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h5 class="my-2">Biaya Layanan</h5>
                                @php
                                    $transaksi = \App\Models\TransaksiBiayaPermohonan::where(
                                        'ppat_id',
                                        $ppat->id,
                                    )->first();
                                @endphp
                                @if ($ppat->status_layanan == 2)
                                    @if ($transaksi == null)
                                        <button class="btn btn-primary float-right" id="pay-button">Bayar</button>
                                        {{-- <a href="{{ route('ppat.pembayaran', $ppat->id) }}"
                                            class="btn btn-primary float-right" id="pay-button">Bayar</a> --}}
                                    @elseif ($transaksi->count() > 0 && $transaksi->status == 'lunas')
                                        <button class="btn btn-primary float-right disabled">Sudah Lunas</button>
                                    @elseif ($transaksi->count() > 0 && $transaksi->status == 'belum lunas')
                                        {{-- <a href="{{ route('ppat.pembayaran', $ppat->id) }}"
                                            class="btn btn-primary float-right" id="pay-button">Bayar</a> --}}
                                        <button class="btn btn-primary float-right" id="pay-button">Bayar</button>
                                    @endif
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-hover mt-2">
                                        <thead class="text-center">
                                            <tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Biaya</th>
                                                <th>Nama Layanan</th>
                                                <th>Nominal/Harga</th>
                                            </tr>

                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @php
                                                $nominal_layanan = 0;
                                            @endphp

                                            @foreach ($biayalayanan as $layanan)
                                                @php
                                                    $nominal_layanan += $layanan->harga;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $layanan->nama_biaya }}</td>
                                                    <td>{{ $layanan->layanan->nama }}</td>
                                                    <td>{{ 'Rp ' . number_format($layanan->harga, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach

                                            <tr></tr>
                                            <td colspan="3">Total:</td>
                                            <td>{{ 'Rp ' . number_format($nominal_layanan, 0, ',', '.') }}</td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>

                                <hr>
                                <h5 class="my-2">Biaya Tambahan</h5>
                                @if ($ppat->status_layanan == 2 || $ppat->status_layanan == 3)
                                    @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                        <div class="col-md-12 text-right pr-3">
                                            <button type="button" class="btn btn-icon btn-outline-dark" id="verify"><i
                                                    class="feather icon-plus"></i></button>
                                        </div>
                                    @endif
                                @endif
                                @if ($biayaTambahan->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover mt-2">
                                            <thead class="text-center">
                                                <tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Biaya</th>
                                                    <th>Nominal</th>
                                                    <th>Hapus</th>
                                                </tr>

                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @php
                                                    $nominal_tambahan = 0;
                                                @endphp

                                                @foreach ($biayaTambahan as $tambahan)
                                                    @php
                                                        $nominal_tambahan += $tambahan->nominal;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $tambahan->nama_biaya }}</td>
                                                        <td>{{ 'Rp ' . number_format($tambahan->nominal, 0, ',', '.') }}
                                                        </td>
                                                        @if ($ppat->status_layanan == 3)
                                                            @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                                <td>
                                                                    <a
                                                                        href="{{ route('biaya-tambahan.destroy', $tambahan->id) }}"><i
                                                                            class="fas fa-trash text-danger"></i>
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        @else
                                                            @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                                <td>
                                                                    <a href="{{ route('biaya-tambahan.destroy', $tambahan->id) }}"
                                                                        onclick="return false"><i
                                                                            class="fas fa-trash text-danger"></i></a>
                                                                </td>
                                                            @endif
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                <tr class="text-center">
                                                    <td colspan="3">Total:</td>
                                                    <td> {{ 'Rp ' . number_format($nominal_tambahan, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                @if ($ppat->status_layanan == 3)
                                                    @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                        <tr>
                                                            <td colspan="3"></td>

                                                            <td class="text-right">
                                                                <a href="{{ route('ppat.pembayaran-tambahan', $ppat->id) }}"
                                                                    class="btn btn-icon btn-outline-success"><i
                                                                        class="feather icon-check"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-center">Belum ada biaya tambahan</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($ppat->status_layanan == 4)
                        @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                            @php
                                $check = \App\Models\ArsipPpat::where('ppat_id', $ppat->id)->first();
                            @endphp
                            @if ($check == null)
                                <div class="text-center">
                                    <a href="{{ route('arsip-ppat.create', $ppat->id) }}"
                                        class="btn btn-arsipkan my-2 mx-1 text-center">Arsipkan</a>
                                </div>
                            @elseif ($check != null)
                                <div class="text-center">
                                    <button class="btn btn-arsipkan my-2 mx-1 text-center" disabled>Sudah di arsip</button>
                                    {{-- <a href="#" class="btn btn-arsipkan my-2 mx-1 text-center" disabled>Sudah di
                                        arsip</a> --}}
                                </div>
                            @endif
                        @endif

                        <div class="text-center">
                            <a href="{{ route('ppat.cetak', $ppat->id) }}" target="_blank"
                                class="btn btn-cetak my-2 mx-1 text-center">Print</a>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    <div id="snap-container"></div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
    @include('pages.ppat.biaya-tambahan')
@endsection
