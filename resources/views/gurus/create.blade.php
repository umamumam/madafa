@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Tambah Guru</h2>
    <form action="{{ route('gurus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('gurus.form', ['guru' => null])

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
