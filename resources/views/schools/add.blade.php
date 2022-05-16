@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Tambah Profil Sekolah</div>

        <div class="card-body">
            <form id="formGroup" novalidate method="POST" action="{{ route('school.save')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input id="name" name="name" placeholder="Nama Sekolah" type="text" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label for="yayasan">Yayasan</label>
                  <textarea id="yayasan" name="yayasan" type="text" placeholder="Profil Yayasan" class="form-control" required="required"></textarea>
                </div>
                <div class="form-group">
                  <label for="vision">Visi</label>
                  <textarea id="vision" name="vision" placeholder="Visi Sekolah" required="required" class="editor-visi form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="mission">Misi</label>
                  <textarea id="mission" name="mission" placeholder="Misi Sekolah" class="form-control editor-misi" required="required"></textarea>
                </div>
                <div class="form-group">
                    <label for="link_video">Video Sambutan</label>
                    <input type="text" id="link_video" name="link_video" placeholder="Masukan url youtube/video sambutan sekolah" required="required" class="form-control"></input>
                  </div>
                <div class="form-group">
                    <label for="mission">Kepala Sekolah</label>
                    <input type="file" accept="image/x-png,image/png,image/jpeg" name="headmaster_pic" placeholder="Choose image" id="headmaster_pic">
                </div>
                <div class="col-md-12 mb-2">
                    <img id="preview-headmasterpic" src="https://raw.githubusercontent.com/raihan71/vue-mosque/master/public/assets/img/team/person.png"
                        alt="preview image" style="max-height: 200px;">
                </div>
                <div class="form-group">
                    <label for="mission">Struktur Organisasi</label>
                    <input type="file" accept="image/x-png,image/png,image/jpeg" name="structure_org" placeholder="Choose image" id="structure_org">
                </div>
                <div class="col-md-12 mb-2">
                    <img id="preview-structure_org" src="https://raw.githubusercontent.com/raihan71/vue-mosque/master/public/assets/img/team/person.png"
                        alt="preview image" style="max-height: 200px;">
                </div>
                <div class="form-group pull-right">
                  <button type="button" data-toggle="modal" data-target="#formConfirmation" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title-confirm')
Apakah kamu yakin akan menyimpan ini?
@stop

@push('scripts')
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
