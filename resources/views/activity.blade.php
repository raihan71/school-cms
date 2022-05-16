@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header"><i class="fa fa-history" aria-hidden="true"></i> Riwayat Aktivitas</div>

        <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Tanggal</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <th scope="row">{{ $loop->index+1}}</th>
                        <td><strong>{{$activity->person }}</strong> {{$activity->desc}}</td>
                        <td>{!! date('d M Y H:i:s', strtotime($activity->created_at)) !!}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="pull-right">
                {!! $activities->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
