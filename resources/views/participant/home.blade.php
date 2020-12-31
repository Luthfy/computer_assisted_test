@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-4">
        <div class="card-body">
            <h3>Informasi Data Peserta</h3>
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
    </div>
</div>

@endsection
