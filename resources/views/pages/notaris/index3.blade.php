@extends('layouts.master')

@section('content')
    <style>
        .more-text {
            text-align: center !important;
            max-width: 250px !important;
            white-space: pre-line !important;

        }

        .custome-size {
            font-size: 100% !important;
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
                            <div class="alert alert-danger mt-4">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <a href="{{ route('notaris.layanan') }}" class="btn btn-primary mt-4">Buat Pengajuan</a>
                        <div class="alert alert-info my-2">
                            <i class="feather icon-info"></i> <b>INFO</b> : &nbsp; Pengajuan sudah terverifikasi silahkan
                            cek detail pengajuan untuk melihat informasi selanjutnya
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Layanan Permohonan</th>
                                        <th>Nomor Pengajuan | Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($data as $item)
                                        @php
                                            $status = null;

                                            switch ($item->status_layanan) {
                                                case '0':
                                                    $status = 'Dibatalkan';
                                                    break;
                                                case '1':
                                                    $status = 'Menunggu Konfirmasi';
                                                    break;
                                                case '2':
                                                    $status = 'Dikonfirmasi';
                                                    break;
                                                case '3':
                                                    $status = 'Terverifikasi';
                                                    break;
                                                case '4':
                                                    $status = 'Selesai';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                        @endphp
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $item->user->nama }}</td>
                                            <td>

                                                {{ $item->layanan->nama }} |
                                                <div class="badge badge-info">
                                                    {{ $item->layanan->jenisPermohonan->nama }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $item->nomor_pengajuan }} |
                                                @if ($item->status_layanan == '0')
                                                    <div class="badge badge-secondary">
                                                        {{ $status }}
                                                    </div>
                                                @else
                                                    <div class="badge badge-success">
                                                        {{ $status }}
                                                    </div>
                                                @endif

                                                {{-- <div class="alert alert-warning">

                                                    <p class="text-center custome-size">
                                                        <i class="feather icon-alert-circle"></i>
                                                        pengajuan ditolak / silahkan melakukan pengajuan ulang
                                                    </p>
                                                </div> --}}


                                            </td>
                                            <td>
                                                <a href="{{ route('notaris.show', $item->id) }}" class="btn btn-secondary">
                                                    Detail
                                                </a>
                                                {{-- <a href="{{ route('ppat.edit', $item->id) }}"
                                                    class="btn btn-warning">Edit</a> --}}
                                                @if (auth()->user()->type_user == 'admin' || auth()->user()->type_user == 'master')
                                                    <form action="{{ route('notaris.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Batalkan</button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
