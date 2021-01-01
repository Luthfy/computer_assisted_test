<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Test;
use App\Models\Selection;
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
        $selections = Selection::all();

        foreach ($selections as $value) {
            $selection_parsing[$value->id] = $value->code_group_question . " - " . $value->name_group_question;
        }

        $data = [
            "title" => 'Tambah Kelompok Jenis Tes',
            "data" => null,
            "selection_group" => $selection_parsing
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

        $insert = Test::create($request->only(['code_sub_group_question', 'name_sub_group_question', 'passing_grade', 'group_question_id']));

        if ($insert)
        {
            return redirect('control-panel/test')->with('info', $request->name_sub_group_question . ' berhasil ditambahkan');
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
        $selections = Selection::all();

        foreach ($selections as $value) {
            $selection_parsing[$value->id] = $value->code_group_question . " - " . $value->name_group_question;
        }

        $test = Test::findOrFail($id);

        $data = [
            "title" => 'Ubah Data Kelompok Tes',
            "data" => $test,
            'selection_group' => $selection_parsing
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
        $selection->passing_grade            = $request->passing_grade;

        if ($request->group_question_id != null) {
            $selection->group_question_id = $request->group_question_id;
        }

        $insert = $selection->save();

        if ($insert)
        {
            return redirect('control-panel/test/' . $id)->with('info', $selection->name_sub_group_question . ' berhasil diperbarui');
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
