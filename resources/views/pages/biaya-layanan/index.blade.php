@extends('layouts.master')

@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header index-card">
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

                        <a href="javascript:void(0)" class="btn btn-primary mb-2" id="btn-create-post">Tambah</a>
                        {{-- <button type="button" class="btn  btn-primary" data-toggle="modal"
                            data-target="#exampleModalLive">Tambah</button> --}}
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Layanan Permohonan</th>
                                        <th>Option</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <style>
                                        .deskripsi {
                                            max-width: 250px !important;
                                            white-space: pre-line !important;
                                        }
                                    </style>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <p style="font-size: 16px">
                                                    {{ $item->nama }}
                                                </p>
                                                <div class="badge badge-info">
                                                    {{ $item->nama_jenis }}
                                                </div>

                        </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('biaya.show', $item->id) }}" class="btn btn-dark">Detail</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @include('pages.biaya-layanan.create')
    {{-- @include('pages.biaya-layanan.edit') --}}
@endsection
