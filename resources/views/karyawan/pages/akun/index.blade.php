@extends('layouts.karyawan.karyawan')

@section('content')
    <div class="row mt">
        <div class="col-lg-12">
            <div class="row content-panel">
                <!-- /col-md-4 -->
                <div class="col-md-4 centered">
                    <div class="profile-pic">
                        <p><img src="{{ asset('img/user.png') }}" class="img-circle"></p>
                    </div>
                </div>
                <!-- /col-md-4 -->
                <div class="col-md-4 profile-text">
                    <h3>{{ auth('karyawan')->user()->nama_pengguna }}</h3>
                    <h6>{{ ucfirst(auth('karyawan')->user()->jabatan) }}</h6>
                    <p>{{ auth('karyawan')->user()->alamat }}</p>
                </div>
                <!-- /col-md-4 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /col-lg-12 -->
        <div class="col-lg-12 mt">
            <div class="row content-panel">
                <!-- /panel-heading -->
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="edit" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 detailed">
                                    <h4 class="mb">Informasi Pribadi</h4>
                                    <form role="form" class="form-horizontal" method="post" action="{{ route('karyawan.akuns.update', ['akun' => auth('karyawan')->id()]) }}">
                                        @if(session()->has('success-biodata'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success-biodata') }}
                                            </div>
                                        @endif
                                        @csrf
                                        @method('put')
                                        <div class="form-group @error('nama_pengguna') has-error @enderror">
                                            <label class="col-lg-2 control-label">Nama Pengguna</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " name="nama_pengguna" id="c-name" class="form-control" value="{{ old('nama_pengguna', auth('karyawan')->user()->nama_pengguna) }}">
                                                @error('nama_pengguna')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('alamat') has-error @enderror">
                                            <label class="col-lg-2 control-label">Alamat</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" class="form-control" id="" name="alamat">{{ old('alamat', auth('karyawan')->user()->alamat) }}</textarea>
                                                @error('alamat')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('no_telp') has-error @enderror">
                                            <label class="col-lg-2 control-label">Nomor Telepon</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " id="country" name="no_telp" class="form-control" value="{{ old('no_telp', auth('karyawan')->user()->no_telp) }}">
                                                @error('no_telp')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('email') has-error @enderror">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-10">
                                                <input type="email" placeholder=" " id="lives-in" name="email" class="form-control" value="{{ old('email', auth('karyawan')->user()->email) }}">
                                                @error('email')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
{{--                                        <div class="form-group @error('username') has-error @enderror">--}}
{{--                                            <label class="col-lg-2 control-label">Username</label>--}}
{{--                                            <div class="col-lg-10">--}}
{{--                                                <input type="text" placeholder=" " id="lives-in" name="username" class="form-control" value="{{ old('username', auth('karyawan')->user()->username) }}">--}}
{{--                                                @error('username')--}}
{{--                                                    <p class="help-block">{{ $message }}</p>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-theme" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-8 col-lg-offset-2 detailed mt">
                                    <h4 class="mb">Ganti Password</h4>
                                    <form role="form" class="form-horizontal" action="{{ route('karyawan.akuns.update.password', ['akun' => auth('karyawan')->id()]) }}" method="post">
                                        @if(session()->has('success-password'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success-password') }}
                                            </div>
                                        @endif
                                        @csrf
                                        @method('put')
                                        <div class="form-group @error('old_password') has-error @enderror">
                                            <label class="col-lg-2 control-label">Password Lama</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="old_password" placeholder=" " id="addr1" class="form-control">
                                                @error('old_password')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('new_password') has-error @enderror">
                                            <label class="col-lg-2 control-label">Password Baru</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="new_password" placeholder=" " id="addr2" class="form-control">
                                                @error('new_password')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('new_password_confirmation') has-error @enderror">
                                            <label class="col-lg-2 control-label">Ulangi Password Baru</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="new_password_confirmation" placeholder=" " id="phone" class="form-control">
                                                @error('new_password_confirmation')
                                                    <p class="help-block">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-theme" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /col-lg-8 -->
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /tab-pane -->
                    </div>
                    <!-- /tab-content -->
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
    </div>
@endsection
