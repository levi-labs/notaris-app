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

                    </div>
                    @endif
                </div>
                <div class="card-body">
                    {{-- <h5>Form controls</h5> --}}
                    <a href="{{ route('ppat.layanan') }}" class="btn btn-secondary">Kembali</a>
                    <div class="alert alert-info mt-4">
                        <h5 class="alert-heading text-danger">Syarat dan Ketentuan layanan permohonan {{ $data->nama }}
                        </h5>
                        <div class="mt-4">
                            {!! $data->syarat_ketentuan !!}
                        </div>

                    </div>
                    <hr>
                    <div class="row justify-content-center">

                        <div class="col-md-6">
                            <form action="{{ route('ppat.store') }}" method="POST" enctype="multipart/form-data">
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



                                @switch(strtolower($data->nama))
                                    @case('akta jual beli')
                                        <div class="form-group">
                                            <span class="text-dark">KTP & KK Penjual dan Pembeli*</span>
                                            <div class="custom-file my-2">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                    name="ktp_kk_penjual_pembeli">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                @error('ktp_kk_penjual_pembeli')
                                                    <p class="text-danger" id="ktp_kk_penjual_pembeli-error"> {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <span class="text-dark">NPWP Penjual dan Pembeli*</span>
                                            <div class="custom-file my-2">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02"
                                                    name="npwp_penjual_pembeli">
                                                <label class="custom-file-label" for="inputGroupFile2">Choose file</label>
                                                @error('npwp_penjual_pembeli')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="text-dark">Bukti lunas PBB tahun terakhir*</span>
                                            <div class="custom-file my-2">
                                                <input type="file" class="custom-file-input" id="inputGroupFile03"
                                                    name="bukti_lunas_pbb">
                                                <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                                @error('bukti_lunas_pbb')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="text-dark">Sertifikat tanah (jika belum ada lampirkan Girik)*</span>
                                            <div class="custom-file my-2">
                                                <input type="file" class="custom-file-input" id="inputGroupFile04"
                                                    name="sertifikat_tanah">
                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                @error('sertifikat_tanah')
                                                    <p class="text-danger mb-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="text-dark">Buku Nikah*</span>
                                            <div class="custom-file my-2">
                                                <input type="file" class="custom-file-input" id="inputGroupFile05"
                                                    name="buku_nikah">
                                                <label class="custom-file-label" for="inputGroupFile5">Choose
                                                    file</label>
                                                @error('buku_nikah')
                                                    <p class="text-danger mb-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    @break

                                    @case('akta hibah')
                                        <span class="text-dark">KTP & KK Penjual dan Pembeli*</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <span class="text-dark">NPWP Penjual dan Pembeli*</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <span class="text-dark">Bukti lunas PBB tahun terakhir*</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <span class="text-danger">Sertifikat tanah (jika belum ada lampirkan Girik)*</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <span class="text-danger">Buku Nikah*</span>
                                        <div class="custom-file my-2">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    @break

                                    @default
                                @endswitch

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
