@extends('layouts.member.member')

@section('content')
    <style>
        textarea {
            resize: none;
            height: 150px;
        }
    </style>
    <div class="container mt-5 pt-5">
        <div class="main-body mt-5 mb-5">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset('img/user.png') }}" alt="Account" class="" width="150px" height="150px">
                                <div class="mt-3">
                                    <h4>{{ auth('member')->user()->nama_member }}</h4>
                                    <p class="text-secondary mb-1">{{ auth('member')->user()->email }}</p>
                                    <p class="text-muted font-size-sm">{{ auth('member')->user()->alamat_member }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card mb-3">
                            <div class="card-header">Ubah password</div>
                            <div class="card-body">
                                <form action="{{ route('member.akuns.update.password', ['akun' => auth('member')->id()]) }}" method="post">
                                    @csrf
                                    @method('put')

                                    @if(session()->has('success-password'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success-password') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h6 class="mb-0">Password Lama</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}">
                                            @error('old_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h6 class="mb-0">Password Baru</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}">
                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h6 class="mb-0">Konfirmasi Password Baru</h6>
                                        </div>
                                        <div class="col-sm-7 text-secondary">
                                            <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" value="{{ old('new_password_confirmation') }}">
                                            @error('new_password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">Biodata</div>
                        <div class="card-body">
                            <form action="{{ route('member.akuns.update', ['akun' => auth('member')->id()]) }}" method="post">
                                @csrf
                                @method('put')

                                @if(session()->has('success-biodata'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success-biodata') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="nama_member" class="form-control @error('nama_member') is-invalid @enderror" value="{{ old('nama_member', auth('member')->user()->nama_member) }}">
                                        @error('nama_member')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth('member')->user()->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nomor Telp</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="hp" class="form-control @error('hp') is-invalid @enderror" value="{{ old('hp', auth('member')->user()->hp) }}">
                                        @error('hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="alamat_member" class="form-control @error('alamat_member') is-invalid @enderror">{{ old('alamat_member', auth('member')->user()->alamat_member) }}</textarea>
                                        @error('alamat_member')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
