@extends('layouts.app')

@section('content')

<div class="container">
    @foreach ($data as $item)
        <div class="card">
            <div class="card-body">
                <ol>
                    @foreach ($item as $exam)
                        <li>
                            Paket Ujian : {!! $exam->package_exam !!}
                            <a href="/participant/app/exam/{{ $exam->code_exam }}">Mulai Uijan</a>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    @endforeach
</div>

@endsection
