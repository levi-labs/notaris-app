@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        {{-- <h5>Form controls</h5> --}}


                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <form action="{{ route('layanan.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Jenis Permohonan</label>
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            name="jenis_permohonan_id">
                                            <option selected disabled>Pilih Jenis Layanan Permohonan</option>
                                            @foreach ($jenis_permohonan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Layanan Permohonan</label>
                                        <input placeholder="" class="form-control" text="text" name="nama">
                                        @error('nama')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                                    <div id="quill-editor-deskripsi" class="mb-3" style="height: 200px;"></div>
                                    <textarea rows="3" class="mb-3 d-none" name="deskripsi" id="quill-editor-area-deskripsi"></textarea>
                                    @error('deskripsi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <label for="exampleFormControlTextarea1">Syarat & Ketentuan</label>
                                    <div id="quill-editor-syarat" class="mb-3" style="height: 200px;"></div>
                                    <textarea rows="3" class="mb-3 d-none" name="syarat_ketentuan" id="quill-editor-area-syarat"></textarea>
                                    @error('deskripsi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    {{-- <div id="editor">

                                    </div>
                                    <textarea class="form-control" id="quill-editor-area" rows="5" name="deskripsi"></textarea>
                                    @error('deskripsi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror --}}



                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        {{-- <h5 class="mt-5">Sizing</h5> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('quill-editor-area-deskripsi') && document.getElementById(
                    'quill-editor-area-syarat')) {
                var deskripsi = new Quill('#quill-editor-deskripsi', {
                    theme: 'snow'
                });
                var syarat = new Quill('#quill-editor-syarat', {
                    theme: 'snow'
                });
                var deskQuillEditor = document.getElementById('quill-editor-area-deskripsi');
                var syaratQuillEditor = document.getElementById('quill-editor-area-syarat');
                deskripsi.on('text-change', function() {
                    deskQuillEditor.value = deskripsi.root.innerHTML;
                });

                syarat.on('text-change', function() {
                    syaratQuillEditor.value = syarat.root.innerHTML;
                });

                syaratQuillEditor.addEventListener('input', function() {
                    syarat.root.innerHTML = syaratQuillEditor.value;
                });


                deskQuillEditor.addEventListener('input', function() {
                    deskripsi.root.innerHTML = deskQuillEditor.value;
                });
            }
        });
    </script>
@endsection
