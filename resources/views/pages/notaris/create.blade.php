@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        {{-- <h5>Form controls</h5> --}}
                        <a href="{{ route('notaris.layanan') }}" class="btn btn-secondary">Kembali</a>
                        <div class="alert alert-info mt-4">
                            <h5 class="alert-heading text-danger">Syarat dan Ketentuan layanan permohonan
                                {{ $data->nama }}
                            </h5>
                            <div class="mt-4">
                                {!! $data->syarat_ketentuan !!}
                            </div>

                        </div>
                        <hr>
                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <form action="{{ route('notaris.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="layanan_permohonan_id" value="{{ $data->id }}">
                                    <div class="form-group">
                                        <label>Nama Pihak Pertama</label>
                                        <input placeholder="Budi ruslan" class="form-control" text="text"
                                            name="nama_pihak_pertama">
                                        @error('nama_pihak_pertama')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pihak Kedua</label>
                                        <input placeholder="John doe" class="form-control" text="text"
                                            name="nama_pihak_kedua">
                                        @error('nama_pihak_kedua')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Alamat Aset Termohon</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat_asset_termohon"></textarea>
                                        @error('alamat_asset_termohon')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <hr>
                                        <div class="alert alert-warning">
                                            <h5 class="alert-heading text-danger">Upload Dokumen Berupa Format PDF max 2 MB
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-dark">Berkas Syarat Pengajuan dijadikan satu file *</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="file_notaris"
                                                name="file_notaris">
                                            <label class="custom-file-label" for="file_notaris">Choose
                                                file</label>
                                            @error('file_notaris')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </form>
                            </div>
                        </div>
                        {{-- <h5 class="mt-5">Sizing</h5> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        const input = document.getElementById('inputGroupFile01');
        const errorElement = document.getElementById('ktp_kk_penjual_pembeli-error');
        console.log(errorElement);
        input.addEventListener('change', function() {
            const file = input.files[0];
            if (file) {
                if (file.type !== 'application/pdf') {
                    errorElement.textContent = 'File must be a PDF';
                    console.log(errorElement);
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    errorElement.textContent = 'File size must be less than 2MB';
                    return;
                }
                errorElement.textContent = '';
            }
        });
    </script> --}}
@endsection
