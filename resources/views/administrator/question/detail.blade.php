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
                            <td colspan="2">
                                <p>Pertanyaan !</p>
                                <p>{{ $data->text_question }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>A. {{ $data->answers[0]->text_answer }} {{ $data->answers[0]->is_true == 1 ? "(benar)" : '' }}</p>
                                <p>B. {{ $data->answers[1]->text_answer }} {{ $data->answers[1]->is_true == 1 ? '(benar)' : '' }}</p>
                                <p>C. {{ $data->answers[2]->text_answer }} {{ $data->answers[2]->is_true == 1 ? '(benar)' : '' }}</p>
                                <p>D. {{ $data->answers[3]->text_answer }} {{ $data->answers[3]->is_true == 1 ? '(benar)' : '' }}</p>
                                {{-- <p>E. {{ $data->answers[4]->text_answer }}</p> --}}
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

                </div>
                <div class="card-footer">
                    Footer
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

