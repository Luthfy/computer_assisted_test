<?php

namespace App\Http\Controllers\Participant;

use App\User;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            "title" => 'Dashboard EduCPNS V1',
            "data" => User::find(Auth::id())
        ];

        return view('participant.home', $data);
    }

    public function materi()
    {
        $data = [
            "title" => 'Materi EduCPNS V1',
            "data" => Material::all()
        ];

        return view('participant.materi', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exam()
    {
        $data = [
            "title" => 'Daftar Ujian',
            "data" => [
                Exam::where('user_id', Auth::user()->id)->get()
            ]
        ];

        return view('participant.exam', $data);
    }

}
