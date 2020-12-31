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
            <div class="card">
                <div class="card-body">

                    @if ($data == null)
                        {!! Form::open(['url' => 'control-panel/participant', 'method' => 'post']) !!}
                    @else
                        {!! Form::model($data, ['url' => "control-panel/participant/$data->id", 'method' => 'put']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('name', 'Nama Peserta') !!}
                        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Masukan Nama Peserta']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'E-Mail Peserta') !!}
                        {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Masukan E-Mail Peserta']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Masukan Password']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone', 'No Hp / Telephone') !!}
                        {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Masukan No Hp Peserta']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Alamat') !!}
                        {!! Form::textarea('address', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('origin', 'Asal') !!}
                        {!! Form::text('origin', null, ['class'=>'form-control', 'placeholder'=>'Masukan Asal Peserta']) !!}
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ url('control-panel/participant') }}" class="btn btn-secondary">Kembali</a>
                        <input type="reset" value="Batal" class="btn btn-danger">
                        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop
