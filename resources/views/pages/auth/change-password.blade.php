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
                        {{-- <a class="btn btn-secondary" href="{{ route('ppat.show', $ppat->id) }}">Kembali</a> --}}
                        {{-- <h5>Form controls</h5> --}}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form action="{{ route('user.update-password', auth()->user()->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input placeholder="" class="form-control" text="password" name="password_lama">
                                        @error('password_lama')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input placeholder="" class="form-control" text="password" name="password_baru">
                                        @error('password_baru')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
    <script></script>
@endsection
