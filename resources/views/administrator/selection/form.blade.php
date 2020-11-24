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
                        {!! Form::open(['url' => 'control-panel/selection', 'method' => 'post']) !!}
                    @else
                        {!! Form::model($data, ['url' => "control-panel/selection/$data->id", 'method' => 'put']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('code_group_question', 'Kode Jenis Seleksi') !!}
                        {!! Form::text('code_group_question', null, ['class'=>'form-control', 'placeholder'=>'Masukan Kode Jenis Seleksi']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name_group_question', 'Nama Jenis Seleksi') !!}
                        {!! Form::text('name_group_question', null, ['class'=>'form-control', 'placeholder'=>'Masukan Nama Jenis Seleksi']) !!}
                    </div>

                    <div class="form-group text-right">
                        <input type="reset" value="Batal" class="btn btn-danger">
                        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
