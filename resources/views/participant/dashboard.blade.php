@extends('layouts.app')

@section('content')

<div class="container">
    @foreach ($data as $item)
        <div class="card">
            <div class="card-body">
                @foreach ($item as $exam)
                    Paket Ujian : {!! $exam->package_exam !!}
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@endsection
