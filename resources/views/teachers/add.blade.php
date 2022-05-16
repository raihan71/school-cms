@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Tambah Guru</div>

        <div class="card-body">
            <form id="formGroup" novalidate method="post" action="{{ route('teacher.save')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input id="name" name="name" placeholder="Nama Lengkap Dan Gelar" type="text" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input id="nip" name="nip" placeholder="Nomor Identitas Pegawai" type="text" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label for="subject">Mata Pelajaran</label>
                  <input id="subject" name="subject" placeholder="Pelajaran Yang Diampu" type="text" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <label for="mission">Foto</label>
                    <input type="file" accept="image/x-png,image/png,image/jpeg" name="image" placeholder="Choose image" id="pic">
                </div>
                <div class="col-md-12 mb-2">
                    <img id="preview-pic" src="https://raw.githubusercontent.com/raihan71/vue-mosque/master/public/assets/img/team/person.png"
                        alt="preview image" style="max-height: 200px;">
                </div>
                <div class="form-group pull-right">
                  <button type="button" data-toggle="modal" data-target="#formConfirmation" class="btn btn-primary">Submit</button>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection

@section('title-confirm')
Apakah kamu yakin akan menambah data ini?
@stop

@push('scripts')
<script type="text/javascript">
    $(document).ready(function (e) {
       $('#pic').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#preview-pic').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
       });
    });
</script>
@endpush
