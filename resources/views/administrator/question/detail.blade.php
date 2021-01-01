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
                <div class="card-header">
                    Kolom Detail Pertanyaan
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Kode Seleksi</td>
                            <td>: <b>{{ $data->selection->name_group_question }}</b> <b>({{ $data->selection->code_group_question }})</b></td>
                        </tr>
                        <tr>
                            <td>Kode Test</td>
                            <td>:  <b>{{ $data->test->name_sub_group_question }}</b><b>({{ $data->test->code_sub_group_question }})</b></td>
                        </tr>
                        <tr>
                            <td>
                                Subject Test
                            </td>
                            <td>
                                : <b>{{ $data->sub_test }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Pertanyaan!</p>
                                <p>{{ $data->text_question }}</p>
                                <p>Jawaban!</p>
                                <p>{{ $data->correct_question }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>A. {{ $data->answers[0]->text_answer }} (poin:{{ $data->answers[0]->poin_answer }})</p>
                                <p>B. {{ $data->answers[1]->text_answer }} (poin:{{ $data->answers[1]->poin_answer }})</p>
                                <p>C. {{ $data->answers[2]->text_answer }} (poin:{{ $data->answers[2]->poin_answer }})</p>
                                <p>D. {{ $data->answers[3]->text_answer }} (poin:{{ $data->answers[3]->poin_answer }})</p>
                                <p>E. {{ $data->answers[4]->text_answer }} (poin:{{ $data->answers[4]->poin_answer }})</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-6">
                            <a href='{{url("control-panel/questions/$data->id/edit")}}' class="btn btn-success btn-block">Edit</a>
                        </div>
                        <div class="col-6">
                            <a href="#" onclick="delete_data()" class="btn btn-danger btn-block">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Kolom Pembahasan
                </div>
                <div class="card-body">
                    @if ($pembahasan == null)
                    <a class='btn btn-info' href='{{url("control-panel/problem_solving/$data->id/create")}}'>Tambah Pembahasan</a>
                    @else
                        {!! $pembahasan->text_problem_solving !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
function delete_data()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = '{{ url("control-panel/questions/$data->id") }}'
    $.ajax({
        url: url,

        type: 'DELETE',
        success: function(result) {
            // Do something with the result
            if (result)
            {
                confirm("delete sukses")
                window.location.href = "{{ url('control-panel/questions') }}"
            }
            else
            {
                confirm("delete gagal")
            }
        }
    });
}
</script>
@endpush

