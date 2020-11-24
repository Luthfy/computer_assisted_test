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
                            <td>Kode Kelompok Seleksi</td>
                            <td>: <b>{{ $data->code_group_question }}</b></td>
                        </tr>
                        <tr>
                            <td>Nama Kelompok Seleksi</td>
                            <td>: <b>{{ $data->name_group_question }}</b></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href='{{url("control-panel/selection/$data->id/edit")}}' class="btn btn-success btn-block">Edit</a>
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

    let url = '{{ url("control-panel/selection/$data->id") }}'
    $.ajax({
        url: url,

        type: 'DELETE',
        success: function(result) {
            // Do something with the result
            if (result)
            {
                confirm("delete sukses")
                window.location.href = "{{ url('control-panel/selection') }}"
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

