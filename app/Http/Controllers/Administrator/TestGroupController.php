<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\GroupTestDataTable;

class TestGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupTestDataTable $datatable)
    {
        $data = [
            "title" => 'Data Kelompok Jenis Tes',
            "data" => null
        ];

        return $datatable->render('administrator.test.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "title" => 'Tambah Kelompok Jenis Tes',
            "data" => null
        ];

        return view('administrator.test.form', $data);
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
            'code_sub_group_question' => 'required',
            'name_sub_group_question' => 'required',
        ]);

        $selection = new Test();
        $selection->code_sub_group_question  = $request->code_sub_group_question;
        $selection->name_sub_group_question  = $request->name_sub_group_question;
        $insert = $selection->save();

        if ($insert)
        {
            return redirect('control-panel/test')->with('info', $selection->name_sub_group_question . ' berhasil ditambahkan');
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
        $test = Test::findOrFail($id);

        $data = [
            'title' => 'Detail Jenis Tes',
            'data' => $test
        ];

        return view('administrator.test.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $test = Test::findOrFail($id);

        $data = [
            "title" => 'Ubah Data Kelompok Seleksi',
            "data" => $test
        ];

        return view('administrator.test.form', $data);
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
            'code_sub_group_question' => 'required',
            'name_sub_group_question' => 'required',
        ]);

        $selection = Test::find($id);
        $selection->code_sub_group_question  = $request->code_sub_group_question;
        $selection->name_sub_group_question  = $request->name_sub_group_question;
        $insert = $selection->save();

        if ($insert)
        {
            return redirect('control-panel/test')->with('info', $selection->name_sub_group_question . ' berhasil ditambahkan');
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
        $delete = Test::findOrFail($id)->delete();

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
