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

            @if ($data == null)
                {!! Form::open(['url' => 'control-panel/questions', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::model($data, ['url' => "control-panel/questions/$data->id", 'method' => 'put']) !!}
            @endif

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
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Kolom Pertanyaan
                </div>
                <div class="card-body">

                    <div class="form-group" id="question">

                        <div class="form-group">
                            {!! Form::label('sub_test', 'Sub Tes') !!}
                            {!! Form::text('sub_test', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('text_question', 'Masukan Teks Pertanyaan') !!}
                            {!! Form::textarea('text_question', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('media_question', 'Masukan File jika ada') !!}
                            {!! Form::file('media_question', ['class'=>'form-control-file']) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Kolom Jawaban
                </div>
                <div class="card-body">
                    @if ($data != null)
                    <div class="form-group" id="option-answer">
                        <div class="form-check mb-3">
                            <div class="col-12 row justify-content-between">
                                {!! Form::hidden('id_answer_a', $data->answers[0]->id) !!}
                                {!! Form::radio('is_true', 0, $data->answers[0]->is_true == 1 ? true : false, ['class'=>'form-check-input']) !!}
                                <div class="col-11">
                                    {!! Form::text('text_answer_a', $data->answers[0]->text_answer, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                                </div>
                                <div class="col-1">
                                    {!! Form::number('text_poin_a', $data->answers[0]->poin_answer, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 row justify-content-between">
                            {!! Form::hidden('id_answer_b', $data->answers[1]->id) !!}
                            {!! Form::radio('is_true', 1, $data->answers[1]->is_true == 1 ? true : false, ['class'=>'form-check-input']) !!}
                            <div class="col-11">
                                {!! Form::text('text_answer_b', $data->answers[1]->text_answer, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                            </div>
                            <div class="col-1">
                                {!! Form::number('text_poin_b', $data->answers[1]->poin_answer, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                            </div>
                        </div>

                        <div class="col-12 row justify-content-between">
                            {!! Form::hidden('id_answer_c', $data->answers[2]->id) !!}
                            {!! Form::radio('is_true', 2, $data->answers[2]->is_true == 1 ? true : false, ['class'=>'form-check-input']) !!}
                            <div class="col-11">
                                {!! Form::text('text_answer_c', $data->answers[2]->text_answer, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                            </div>
                            <div class="col-1">
                                {!! Form::number('text_poin_c', $data->answers[2]->poin_answer, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                            </div>
                        </div>

                        <div class="col-12 row justify-content-between">
                            {!! Form::hidden('id_answer_d', $data->answers[3]->id) !!}
                            {!! Form::radio('is_true', 3, $data->answers[3]->is_true == 1 ? true : false, ['class'=>'form-check-input']) !!}
                            <div class="col-11">
                                {!! Form::text('text_answer_d', $data->answers[3]->text_answer, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                            </div>
                            <div class="col-1">
                                {!! Form::number('text_poin_d', $data->answers[3]->poin_answer, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                            </div>
                        </div>

                        <div class="col-12 row justify-content-between">
                            {!! Form::hidden('id_answer_e', $data->answers[4]->id) !!}
                            {!! Form::radio('is_true', 4, $data->answers[4]->is_true == 1 ? true : false, ['class'=>'form-check-input']) !!}
                            <div class="col-11">
                                {!! Form::text('text_answer_e', $data->answers[4]->text_answer, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                            </div>
                            <div class="col-1">
                                {!! Form::number('text_poin_e', $data->answers[4]->poin_answer, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                            </div>
                        </div>

                    </div>
                    @else
                    <div class="form-group" id="option-answer">
                        <div class="form-check mb-3">
                            <div class="col-12 row justify-content-between">
                                {!! Form::radio('is_true', 0, false, ['class'=>'form-check-input']) !!}
                                <div class="col-11">
                                    {!! Form::text('text_answer_a', null, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                                </div>
                                <div class="col-1">
                                    {!! Form::number('text_poin_a', null, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <div class="col-12 row justify-content-between">
                                {!! Form::radio('is_true', 1, false, ['class'=>'form-check-input']) !!}
                                <div class="col-11">
                                    {!! Form::text('text_answer_b', null, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                                </div>
                                <div class="col-1">
                                    {!! Form::number('text_poin_b', null, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <div class="col-12 row justify-content-between">
                                {!! Form::radio('is_true', 2, false, ['class'=>'form-check-input']) !!}
                                <div class="col-11">
                                    {!! Form::text('text_answer_c', null, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                                </div>
                                <div class="col-1">
                                    {!! Form::number('text_poin_c', null, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <div class="col-12 row justify-content-between">
                                {!! Form::radio('is_true', 3, false, ['class'=>'form-check-input']) !!}
                                <div class="col-11">
                                    {!! Form::text('text_answer_d', null, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                                </div>
                                <div class="col-1">
                                    {!! Form::number('text_poin_d', null, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <div class="col-12 row justify-content-between">
                                {!! Form::radio('is_true', 4, false, ['class'=>'form-check-input']) !!}
                                <div class="col-11">
                                    {!! Form::text('text_answer_e', null, ['class'=>'form-control', 'placeholder'=>'Masukan Opsi Jawaban']) !!}
                                </div>
                                <div class="col-1">
                                    {!! Form::number('text_poin_e', null, ['class'=>'form-control', 'placeholder'=>'Poin']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    @endif

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
