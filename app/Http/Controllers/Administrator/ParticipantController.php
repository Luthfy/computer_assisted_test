<?php

namespace App\Http\Controllers\Administrator;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $datatable)
    {
        $data = [
            "title" => 'Data Peserta',
            "data" => null
        ];

        return $datatable->render('administrator.participant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "title" => 'Tambah Peserta',
            "data" => null
        ];

        return view('administrator.participant.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->password         = bcrypt($request->password);
        $user->phone            = $request->phone;
        $user->address          = $request->address;
        $user->origin           = $request->origin;
        $user->user_role        = 'participant';
        $user->remember_token   = Str::random(10);
        $insert = $user->save();

        $user->assignRole('participant');

        if ($insert)
        {
            return redirect('control-panel/participant')->with('info', $user->name . ' berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = [
            'title' => 'Detail Peserta',
            'data' => $user
        ];

        return view('administrator.participant.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id)->where('user_role', 'participant')->first();

        $data = [
            "title" => 'Ubah Data Peserta',
            "data" => $user
        ];

        return view('administrator.participant.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name             = $request->name;
        $user->email            = $request->email;
        if ($request->password != null)
        {
            $user->password = bcrypt($request->password);
        }
        $user->phone            = $request->phone;
        $user->address          = $request->address;
        $user->origin           = $request->origin;
        $insert = $user->save();

        if ($insert)
        {
            return redirect('control-panel/participant')->with('info', $user->name . ' berhasil perbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::findOrFail($id)->delete();

        if ($delete)
        {
            return TRUE;
        }
        else
        {
            return false;
        }
    }
}
