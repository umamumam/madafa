@extends('layouts1.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-warning">
            <strong>Halo {{ $siswa->nama_siswa }}</strong>, belum ada data KDUM untukmu.
        </div>
    </div>
</div>
@endsection
