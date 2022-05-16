@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header"><i class="fa fa-user" aria-hidden="true"></i> Daftar Admin</div>
        <div class="card-body">
            <div class="form-group pull-right">
                <a href="{{ route('teacher.admin.add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Tanggal Dibuat</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->index+1}}</th>
                        <td>{{$user->name }}</td>
                        <td>{{$user->email }}</td>
                        <td>{!! date('d M Y H:i:s', strtotime($user->created_at)) !!}</td>
                        <td>
                            @if ($user->id === 1)
                            <button disabled class="xs btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            @elseif ($user->id === Auth::user()->id)
                            <button disabled class="xs btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            @else
                            <a href="{{route('teacher.admin.delete', $user->id)}}" onclick="return confirm('Apakah kamu yakin menghapus data ini?');">
                                <button class="xs btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="pull-right">
                {!! $users->render() !!}
            </div>
        </div>
    </div>
    <br />
    <div class="card">
        <div class="card-header"><i class="fa fa-user" aria-hidden="true"></i> Daftar Guru</div>
        <div class="card-body">
            <div class="form-group pull-right">
                <a href="{{ route('teacher.add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                <button id="btnImport" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Import</button>
                <form id="formImport" class="d-none" method="post" action="{{ route('teacher.import')}}" enctype="multipart/form-data">
                    @csrf
                    <input id="import" type="file" name="teacher" class="d-none" />
                </form>
                <a class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-question"></i></a>
            </div>
            <div class="col-md-6">
                <form id="formSearch" action="{{ route('teacher.search') }}" method="post">
                    @csrf
                <div class="input-group">
                        <input id="text" placeholder="Cari Nama Guru..." name="search" type="text" class="form-control">
                        <div id="btnSearch" class="input-group-append">
                          <div class="input-group-text">
                            <i class="fa fa-search"></i>
                          </div>
                        </div>
                </div>
                </form>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">NIP</th>
                  <th scope="col">Mengajar</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <th scope="row">{{ $loop->index+1}}</th>
                        <td>{{$teacher->name }}</td>
                        <td>{{$teacher->nip }}</td>
                        <td>{{$teacher->subject }}</td>
                        <td>
                            <a href="{{route('teacher.edit', $teacher->id)}}" title="Edit">
                                <button class="xs btn btn-warning">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                            </a>
                            <a href="{{route('teacher.delete', $teacher->id)}}" onclick="return confirm('Apakah kamu yakin menghapus data ini?');" title="Hapus">
                                <button class="xs btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="pull-right">
                {!! $teachers->render() !!}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Bagaimana cara import ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <ol>
             <li>
                Download format file excel disini.
             </li>
             <li>
                Isi data sesuai dengan format.
             </li>
             <li>
                 Klik tombol import (hijau)
             </li>
             <li>
                 Pilih file excel yang telah diisi sesuai format
             </li>
             <li>
                 Tunggu hasilnya kamu bisa melihat ditabel Daftar Guru
             </li>
         </ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Oke, Mengerti</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnSearch').on('click', function(e) {
                e.preventDefault();
                $('#formSearch').submit();
            });
            $('#btnImport').click(function(e) {
                e.stopPropagation();
                $('#import').on('click', function(e) {
                    $('#formImport').submit();
                })
            })
        })
        function handleImport() {
            $('#import').on('click', function(e) {
                $('#formImport').submit();
            })
        }
    </script>
@endpush
