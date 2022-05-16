@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Tambah Profil Sekolah</div>

        <div class="card-body">
            <form id="formGroup" novalidate method="POST" action="{{ route('school.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input id="name" name="name" value="{{$school->name}}" placeholder="Nama Sekolah" type="text" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label for="yayasan">Yayasan</label>
                  <textarea id="yayasan" name="yayasan" type="text" placeholder="Profil Yayasan" class="form-control" required="required">{{$school->yayasan}}</textarea>
                </div>
                <div class="form-group">
                  <label for="vision">Visi</label>
                  <textarea id="vision" name="vision" placeholder="Visi Sekolah" required="required" class="editor-visi form-control">
                      {{$school->vision}}
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="mission">Misi</label>
                  <textarea id="mission" name="mission" placeholder="Misi Sekolah" class="form-control editor-misi" required="required">
                    {{$school->mission}}
                  </textarea>
                </div>
                <div class="form-group">
                    <label for="link_video">Video Sambutan</label>
                    <input type="text" id="link_video" name="link_video" placeholder="Masukan src embeed youtube/video URL SAJA" required="required" class="form-control" value="{{$school->link_video}}">
                    <iframe width="560" height="315" src="{{$school->link_video}}?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                <div class="form-group">
                    <label for="mission">Kepala Sekolah</label>
                    <input type="file" accept="image/x-png,image/png,image/jpeg" name="headmaster_pic" placeholder="Choose image" id="headmaster_pic">
                    <input type="hidden" readonly="" name="old_headmaster_pic" value="{!!$school->headmaster_pic!!}">
                </div>
                <div class="col-md-12 mb-2">
                    @if(Storage::url($school->headmaster_pic))
                    <a href="{{Storage::url($school->headmaster_pic)}}" name="slider_gambar" data-lightbox="slider" onclick="return false;">
                        <img id="preview-headmasterpic" src="{{Storage::url($school->headmaster_pic)}}" alt="preview image" style="max-height: 200px;">
                    </a>
                    @else
                    <label class="label label-danger"><span>File tidak ada</span></label>
                    @endif
                </div>
                <div class="form-group">
                    <label for="mission">Struktur Organisasi</label>
                    <input type="file" accept="image/x-png,image/png,image/jpeg" name="structure_org" placeholder="Choose image" id="structure_org">
                    <input type="hidden" readonly="" name="old_structure_org" value="{!!$school->structure_org!!}">
                </div>
                <div class="col-md-12 mb-2">
                    @if(Storage::url($school->structure_org))
                    <a href="{{Storage::url($school->structure_org)}}" name="slider_gambar" data-lightbox="slider" onclick="return false;">
                        <img id="preview-structure_org" src="{{Storage::url($school->structure_org)}}" alt="preview image" style="max-height: 200px;">
                    </a>
                    @else
                    <label class="label label-danger"><span>File tidak ada</span></label>
                    @endif
                </div>
                <div class="form-group pull-right">
                    <a href="{{route('school.index')}}" class="btn btn-danger">Batal</a>
                    <button type="button" data-toggle="modal" data-target="#formConfirmation" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title-confirm')
Apakah kamu yakin akan menyimpan perubahan ini?
@stop


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tiny.cloud/1/sgr5fdqf8cupq9xe40vnlly3c3lvawym4mbw9npqdxwflb19/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function (e) {
       $('#headmaster_pic').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#preview-headmasterpic').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
       });
       $('#structure_org').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
              $('#preview-structure_org').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
    tinymce.init({
      selector: 'textarea.editor-misi',
      plugins: 'autolink lists checklist permanentpen powerpaste',
      toolbar: 'casechange formatpainter permanentpen numlist bullist',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      height : "250"
   });
   tinymce.init({
          selector: 'textarea.editor-visi',
          plugins: 'autolink lists checklist permanentpen powerpaste',
          toolbar: 'casechange formatpainter permanentpen numlist bullist',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          height : "250"
       });
  </script>
@endpush
