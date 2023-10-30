<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Client;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller
{
    public function index() {
        return view('sessions.index');
    }

    public function list() {
        return view('sessions.list', ['sessions' => Session::findAll()]);
    } 

    public function create(Request $req) {
        // Verificar si hay una sesión de alquiler activa
        $session = Session::findOne(function($r) use ($req) {
            return $r->maquina = $req->input("maquina");
        });

        if (isset($session)) {
            $session->fin =  Carbon::create($session->fin)->addMinutes($req->input("tiempo"));
            $session->save();

            return view('sessions.created', ['success' => true]);
        }

        // Si no hay una sesión activa, verificar si hay máquina disponible
        $maquinaDisponible = Machine::findOne(function($r) {
            return !$r->en_uso;
        });

        if (!isset($maquinaDisponible)) {
            return response()->view('sessions.created', [
                'success' => false, 
                'message' => 'No hay m&aacute;quina disponible'
            ]);
        }

        // Crear una sesión de alquiler si hay máquina disponible
        $maquinaDisponible->en_uso = true;
        $maquinaDisponible->save();

        $client = Client::findOne(function($r) use ($req) {
            return $r->codigo = $req->input('cliente');
        });

        if (!isset($cliente)) {
            $client = Client::create([
                "codigo" => $req->input("cliente"),
                "nombre" => $req->input("nombre"),
                "apellido" => $req->input("apellido"),
                "fuma" => $req->input("fuma"),
            ]);
        }

        $session = Session::create([
            "maquina" => $maquinaDisponible->numero,
            "cliente" => $client->id,
            "inicio" => Carbon::now(),
            "fin" => Carbon::now()->addMinutes($req->input("tiempo"))
        ]);

        return response()
            ->view('sessions.created', ['success' => true])
            ->header('HX-Trigger', 'session-created');
    }
}
