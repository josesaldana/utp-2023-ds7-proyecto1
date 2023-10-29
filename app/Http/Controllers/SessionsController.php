<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SessionsController extends Controller
{
    public function index() {
        return view('sessions.index');
    }

    public function list() {
        return view('sessions.list', ['sessions' => Session::findAll()]);
    } 
}
