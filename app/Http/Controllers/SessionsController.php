<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    //
    public function index() {
        return view('sessions.index');
    }

    public function list() {
        return view('sessions.list', [
            'sessions' => [[
                'maquina' => 1,
                'cliente' => 'Juan Diaz',
                'tiempo' => '2',
                'inicio' => '2023-10-29T17:30:00'
            ], [
                'maquina' => 5,
                'cliente' => 'Juana Diaz',
                'tiempo' => '1.5',
                'inicio' => '2023-10-29T17:30:00'
            ]]
        ]);
    }

    public function create() {
        
    }
}
