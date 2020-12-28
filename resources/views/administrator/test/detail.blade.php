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
                            <td>Kode Tes</td>
                            <td>: <b>{{ $data->code_sub_group_question }}</b></td>
                        </tr>
                        <tr>
                            <td>Nama Tes</td>
                            <td>: <b>{{ $data->name_sub_group_question }}</b></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href='{{url("control-panel/test/$data->id/edit")}}' class="btn btn-success btn-block">Edit</a>
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
function delete_data()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = '{{ url("control-panel/test/$data->id") }}'
    $.ajax({
        url: url,

        type: 'DELETE',
        success: function(result) {
            // Do something with the result
            if (result)
            {
                confirm("delete sukses")
                window.location.href = "{{ url('control-panel/test') }}"
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

