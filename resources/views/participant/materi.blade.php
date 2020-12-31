@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Daftar Materi EduCPNS V1</h3>
    @if (empty($data))
    <p class="text-center">Materi Tidak Ditemukan</p>
    @else
        @foreach ($data as $item)

        @endforeach
    @endif

</div>

@endsection
