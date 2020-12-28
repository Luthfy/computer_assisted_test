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
                {!! Form::open(['url' => 'control-panel/exams', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::model($data, ['url' => "control-panel/exams/$data->id", 'method' => 'put']) !!}
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::label('code_exam', 'Kode Ujian') !!}
                        {!! Form::text('code_exam', $code_exam, ['class'=>'form-control', 'readonly'=>'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('package_exam', 'Paket Ujian') !!}
                        {!! Form::text('package_exam', $package_exam ?? '', ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('group_question_id', 'Kelompok Seleksi Pertanyaan') !!}
                            {!! Form::select('group_question_id', $selection_group, null, ['placeholder' => 'Pilih Kelompok Seleksi', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('sub_group_question_id', 'Kelompok Tes Pertanyaan') !!}
                            {!! Form::select('sub_group_question_id', $test_group, null, ['placeholder' => 'Pilih Kelompok Tes', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('number_of_question', 'Banyak Soal') !!}
                            {!! Form::number('number_of_question', null, ['class'=>'form-control', 'placeholder'=>'Masukan Jumlah Soal Untuk Sesi Ini']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('duration_exam', 'Lama Pengerjaan (Menit)') !!}
                            {!! Form::number('duration_exam', null, ['class'=>'form-control', 'placeholder'=>'Masukan Lama Pengerjaan Berdasarkan Menit']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('participant_id', 'Peserta') !!}
                            {!! Form::select('participant_id', $participant_group, null, ['placeholder' => 'Pilih Kelompok Seleksi', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
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
