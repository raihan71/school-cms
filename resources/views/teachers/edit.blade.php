@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush


@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Tambah Guru</div>

        <div class="card-body">
            <form id="formGroup" method="post" action="{{ route('teacher.update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $teacher->id}}">
                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input id="name" name="name" placeholder="Nama Lengkap Dan Gelar" type="text" class="form-control" required="required" value="{{$teacher->name}}">
                </div>
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input id="nip" name="nip" placeholder="Nomor Identitas Pegawai" type="text" class="form-control" required="required" value="{{$teacher->nip}}">
                </div>
                <div class="form-group">
                  <label for="subject">Mata Pelajaran</label>
                  <input id="subject" name="subject" placeholder="Pelajaran Yang Diampu" type="text" class="form-control" required="required" value="{{$teacher->subject}}">
                </div>
                <div class="form-group">
                    <label for="mission">Foto</label>
                    <input type="file" accept="image/x-png,image/png,image/jpeg" name="pic" placeholder="Choose image" id="pic">
                    <input type="hidden" readonly="" name="old_pic" value="{!!$teacher->pic!!}">
                </div>
                <div class="col-md-12 mb-2">
                    @if(Storage::url($teacher->pic))
                    <a href="{{Storage::url($teacher->pic)}}" name="slider_gambar" data-lightbox="slider" onclick="return false;">
                        <img id="preview-pic" src="{{Storage::url($teacher->pic)}}" alt="preview image" style="max-height: 200px;">
                    </a>
                    @else
                    <label class="label label-danger"><span>File tidak ada</span></label>
                    @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
