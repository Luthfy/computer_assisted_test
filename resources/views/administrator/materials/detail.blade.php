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
                            <td>ID</td>
                            <td>: <b>{!! str_pad($data->id, 4, "0", STR_PAD_LEFT) !!}</b></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <b>{{ $data->name }}</b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: <b>{{ $data->email }}</b></td>
                        </tr>
                        <tr>
                            <td>No Hp</td>
                            <td>: <b>{{ $data->phone }}</b></td>
                        </tr>
                        <tr>
                            <td>Asal</td>
                            <td>: <b>{{ $data->origin }}</b></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: <b>{{ $data->address }}</b></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href='{{url("control-panel/participant/$data->id/edit")}}' class="btn btn-success btn-block">Edit</a>
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

    let url = '{{ url("control-panel/participant/$data->id") }}'
    $.ajax({
        url: url,

        type: 'DELETE',
        success: function(result) {
            // Do something with the result
            if (result)
            {
                confirm("delete sukses")
                window.location.href = "{{ url('control-panel/participant') }}"
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

