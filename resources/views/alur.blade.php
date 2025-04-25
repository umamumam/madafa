@extends('layouts2.landing')

@section('content')
<div style="text-align: center; padding: 20px;">
    <h1>Alur Pendaftaran Siswa Baru</h1>

    <a href="{{ url('siswas/create') }}" title="Pendaftaran Peserta Didik Baru"
        style="display: inline-block; padding: 10px 20px; margin: 20px 0; background-color: #3490dc; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
        Daftar PPDB
    </a>

    <div style="margin-top: 30px;">
        <img src="alur1.png" alt="Alur 1" style="max-width: 100%; margin-bottom: 20px;">
        <br>
        <img src="alur2.png" alt="Alur 2" style="max-width: 100%;">
    </div>
</div>
@endsection
