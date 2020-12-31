@extends('adminlte::page')

@section('title', ' - ' . $title)

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title ?? '' }}</h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.flash_messages')

            @if ($data == null)
                {!! Form::open(['url' => 'control-panel/problem_solving', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::model($data, ['url' => "control-panel/problem_solving/$data->id", 'method' => 'put']) !!}
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('question_id', 'Pertanyaan') !!}
                        {!! Form::text('question_text', $question->text_question, ['class' => 'form-control', 'readonly' => true]) !!}
                        {!! Form::text('question_id', $question->id, ['class' => 'form-control', 'hidden' => true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('text_problem_solving', 'Masukan Teks Pembahasan') !!}
                        {!! Form::textarea('text_problem_solving', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('media_problem_solving', 'Masukan File jika ada') !!}
                        {!! Form::file('media_problem_solving', ['class'=>'form-control-file']) !!}
                    </div>

                    <div class="form-group text-right">
                        <input type="reset" value="Batal" class="btn btn-danger">
                        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
