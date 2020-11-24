<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\GroupSelectionDataTable;
use App\Models\Selection;

class SelectionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupSelectionDataTable $datatable)
    {
        $data = [
            "title" => 'Data Kelompok Seleksi Tes',
            "data" => null
        ];

        return $datatable->render('administrator.selection.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "title" => 'Tambah Kelompok Seleksi',
            "data" => null
        ];

        return view('administrator.selection.form', $data);
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
            'code_group_question' => 'required',
            'name_group_question' => 'required',
        ]);

        $selection = new Selection();
        $selection->code_group_question  = $request->code_group_question;
        $selection->name_group_question  = $request->name_group_question;
        $insert = $selection->save();

        if ($insert)
        {
            return redirect('control-panel/selection')->with('info', $selection->name_group_question . ' berhasil ditambahkan');
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
        $selection = Selection::findOrFail($id);

        $data = [
            'title' => 'Detail Data Kelompok Seleksi',
            'data' => $selection
        ];

        return view('administrator.selection.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $selection = Selection::findOrFail($id);

        $data = [
            "title" => 'Ubah Data Kelompok Seleksi',
            "data" => $selection
        ];

        return view('administrator.selection.form', $data);
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
            'code_group_question' => 'required',
            'name_group_question' => 'required',
        ]);

        $selection = Selection::find($id);
        $selection->code_group_question  = $request->code_group_question;
        $selection->name_group_question  = $request->name_group_question;
        $insert = $selection->save();

        if ($insert)
        {
            return redirect('control-panel/selection')->with('info', $selection->name_group_question . ' berhasil ditambahkan');
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
        $delete = Selection::findOrFail($id)->delete();

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
