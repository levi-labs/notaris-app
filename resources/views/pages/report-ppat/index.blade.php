@extends('layouts.master')
@section('content')
    <div class="pcoded-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        {{-- <h5>Form controls</h5> --}}


                        <div class="row justify-content-center">

                            <div class="col-md-6">
                                <form action="{{ route('report-ppat.cetak') }}" method="POST" target="_blank">
                                    @csrf
                                    <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <input placeholder="" class="form-control" type="date" id="from"
                                            name="dari_tanggal">
                                        @error('dari_tanggal')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input placeholder="" class="form-control" type="date" id="to"
                                            name="sampai_tanggal">
                                        @error('sampai_tanggal')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <button type="button" id="submit" class="btn btn-primary">Submit</button>
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
            let from = document.getElementById('from');
            let to = document.getElementById('to');
            let submit = document.getElementById('submit');

            from.addEventListener('change', function() {
                if (from.value === '' && to.value === '') {
                    submit.setAttribute('type', 'button');
                } else if (from.value !== '' || to.value !== '') {
                    submit.setAttribute('type', 'submit');
                    submit.removeAttribute('disabled');
                }
            })

            to.addEventListener('change', function() {
                if (from.value === '' && to.value === '') {
                    submit.setAttribute('type', 'button');
                } else if (from.value !== '' || to.value !== '') {
                    submit.setAttribute('type', 'submit');
                    submit.removeAttribute('disabled');
                }
            })

        })
    </script>
@endsection
