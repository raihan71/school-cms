@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Profil Saya</div>

        <div class="card-body">
            <form id="formGroup" method="post" action="{{ route('profile.update')}}">
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-4 col-form-label">Nama</label>
                  <div class="col-8">
                    <input id="name" name="name" value="{{Auth::user()->name}}" placeholder="Nama Lengkap" type="text" class="form-control" required="required">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-4 col-form-label">Email</label>
                  <div class="col-8">
                    <input id="email" name="email" value="{{Auth::user()->email}}" placeholder="Alamat Email" type="text" class="form-control" required="required">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-4 col-form-label">Password</label>
                  <div class="col-8">
                    <input id="password" name="password" placeholder="Password Baru" type="password" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password_confirmation" class="col-4 col-form-label">Confirm Password</label>
                  <div class="col-8">
                    <input id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru" type="password" autocomplete="new-password" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-4 col-8">
                    <button type="button" data-toggle="modal" data-target="#formConfirmation" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection

@section('title-confirm')
Apakah kamu yakin akan menyimpan perubahan ini?
@stop
