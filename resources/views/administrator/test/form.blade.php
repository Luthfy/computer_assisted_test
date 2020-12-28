@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title ?? '' }}</h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.flash_messages')
            <div class="card">
                <div class="card-body">

                    @if ($data == null)
                        {!! Form::open(['url' => 'control-panel/test', 'method' => 'post']) !!}
                    @else
                        {!! Form::model($data, ['url' => "control-panel/test/$data->id", 'method' => 'put']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('code_sub_group_question', 'Kode Tes') !!}
                        {!! Form::text('code_sub_group_question', null, ['class'=>'form-control', 'placeholder'=>'Masukan Kode Tes']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name_sub_group_question', 'Nama Tes') !!}
                        {!! Form::text('name_sub_group_question', null, ['class'=>'form-control', 'placeholder'=>'Masukan Nama Tes']) !!}
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ url('control-panel/test') }}" class="btn btn-secondary">Kembali</a>
                        <input type="reset" value="Batal" class="btn btn-danger">
                        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
