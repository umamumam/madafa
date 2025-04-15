@extends('layouts1.app')

@section('content')
<div class="container">
    <h2>Edit Guru</h2>
    <form action="{{ route('gurus.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('gurus.form', ['guru' => $guru])

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
