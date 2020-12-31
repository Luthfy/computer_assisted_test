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
                    <table class="table">
                        <tr>
                            <td>Kode Ujian</td>
                            <td>: <b>{{ $data->code_exam }}</b></td>
                        </tr>
                        <tr>
                            <td>Paket Ujian</td>
                            <td>: <b>{{ $data->package_exam }}</b></td>
                        </tr>
                        <tr>
                            <td>Grup Seleksi</td>
                            <td>: <b>{{ $data->group_question_id }}</b></td>
                        </tr>
                        <tr>
                            <td>Grup Tes</td>
                            <td>: <b>{{ $data->sub_group_question_id }}</b></td>
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            <td>: <b>{{ $data->duration_exam }}</b> <b>{{ $data->once_exam }}</b></td>
                        </tr>
                        <tr>
                            <td>Jumlah Soal</td>
                            <td>: <b>{{ $data->number_of_question }}</b></td>
                        </tr>
                        <tr>
                            <td>Peserta</td>
                            <td>: <b>{{ $data->user_id }}</b></td>
                        </tr>
                        <tr>
                            <td>Hasil Ujian</td>
                            <td>: <b>{{ $data->test_result ?? '' }}</b></td>
                        </tr>
                        <tr>
                            <td>Tanggal Paket Ujian Dibuat</td>
                            <td>: <b>{{ $data->created_at ?? '' }}</b></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href='#' onclick="create_question()" class="btn btn-success btn-block">Generate Soal Ujian</a>
                        </div>
                        <div class="col-6">
                            <a href="#" onclick="delete_data()" class="btn btn-danger btn-block">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
function create_question()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = '{{ url("control-panel/exams/$data->id/create_question") }}';

    $.ajax({
        url: url,

        type: 'POST',
        success: function(result) {
            // Do something with the result
            console.log(result)
        }
    });
}

function delete_data()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = '{{ url("control-panel/exams/$data->id") }}'
    $.ajax({
        url: url,

        type: 'DELETE',
        success: function(result) {
            // Do something with the result
            if (result)
            {
                confirm("delete sukses")
                window.location.href = "{{ url('control-panel/exams') }}"
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

