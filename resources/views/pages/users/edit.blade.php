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
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Type User</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="type">
                                            <option selected disabled>Pilih Type User</option>
                                            @for ($i = 0; $i < count($types); $i++)
                                                <option {{ $user->type_user == $types[$i] ? 'selected' : '' }}
                                                    value="{{ $types[$i] }}">{{ $types[$i] }}</option>
                                            @endfor
                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input placeholder="" class="form-control" type="text" name="nama"
                                            value="{{ $user->nama }}">
                                        @error('nama')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input placeholder="" class="form-control" type="text" name="email"
                                            value="{{ $user->email }}">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input placeholder="" class="form-control" type="text" name="username"
                                            value="{{ $user->username }}">
                                        @error('username')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

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
@endsection
