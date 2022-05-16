@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Profil Sekolah</div>

        <div class="card-body">
            <div class="form-group pull-right">
                @if (!$school)
                <a href="{{ route('school.add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                @else
                <a href="{{ route('school.show')}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                @endif
            </div>
            @if ($school)
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nama Sekolah</th>
                    <th scope="col">Yayasan</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$school->name}}</td>
                        <td>{!! Str::limit( strip_tags( $school->yayasan ), 50 ) !!}</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Visi</th>
                  <th scope="col">Misi</th>
                </tr>
              </thead>
              <tbody>
                <td>
                    {!! Str::limit( strip_tags( $school->vision ), 200 ) !!}
                </td>
                <td>
                    {!! Str::limit( strip_tags( $school->mission ), 200 ) !!}
                </td>
              </tbody>
            </table>

            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Kepala Sekolah</th>
                    <th scope="col">Struktur Organisasi</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if(Storage::url($school->headmaster_pic))
                            <a href="{{Storage::url($school->headmaster_pic)}}" name="slider_gambar" data-lightbox="slider" onclick="return false;">
                                <img id="preview-headmasterpic" src="{{Storage::url($school->headmaster_pic)}}" alt="preview image" style="max-height: 200px;">
                            </a>
                            @else
                            <label class="label label-danger"><span>File tidak ada</span></label>
                            @endif
                        </td>
                        <td>
                            @if(Storage::url($school->structure_org))
                            <a href="{{Storage::url($school->structure_org)}}" name="slider_gambar" data-lightbox="slider" onclick="return false;">
                                <img id="preview-structureorg" src="{{Storage::url($school->structure_org)}}" alt="preview image" style="max-height: 200px;">
                            </a>
                            @else
                            <label class="label label-danger"><span>File tidak ada</span></label>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
