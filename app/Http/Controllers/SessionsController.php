<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Client;
use App\Models\Machine;
use App\Models\DailySummary;
use App\Jobs\TerminateSession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller
{
    public function index() {
        return view('sessions.index');
    }

    public function list() {
        $activeSessions = Session::findMany(function($r) {
            return $r->estaActiva();
        });

        // Podríamos usar caching aquí si hubiese problemas de performance
        $maquinas = Machine::findAll();
        $maquinas = array_combine(array_column($maquinas, 'id'), $maquinas);

        // Podríamos usar caching aquí si hubiese problemas de performance
        $clientes = Client::findAll();
        $clientes = array_combine(array_column($clientes, 'id'), $clientes);

        $activeSessions = array_map(function($as) use($maquinas, $clientes) {
            $as->maquina = $maquinas[$as->maquina]->numero;
            $as->cliente = $clientes[$as->cliente]->nombre . " " . $clientes[$as->cliente]->apellido;
            return $as;
        }, $activeSessions);

        return view('sessions.list', [
            'sessions' => $activeSessions
        ]);
    } 

    public function summary() {
        $dailySummary = DailySummary::findOne(function($r) {
            return Carbon::parse($r->dia)->isSameDay(Carbon::now());
        });

        if (!isset($dailySummary)) {
            $dailySummary = new DailySummary([
                'id' => 'empty-guid',
                'dia' => Carbon::now(),
                'totalDeSesiones' => 0,
                'totalRecaudado' => 0
            ]);
        }

        $maquinas = Machine::findAll();

        return view('sessions.summary', [
            'summary' => $dailySummary,
            'maquinasEnUso' => count(array_filter($maquinas, function($m) { return $m->en_uso; })),
            'maquinasDisponibles' => count(array_filter($maquinas, function($m) { return !$m->en_uso; }))
        ]);
    }

    public function create(Request $req) {
        // Verificar si hay una sesión de alquiler activa
        $session = Session::findOne(function($r) use ($req) {
            return $r->maquina == $req->input("maquina");
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
                'status' => 'error', 
                'message' => 'No hay máquinas disponible'
            ]);
        }

        // Crear una sesión de alquiler si hay máquina disponible
        $maquinaDisponible->en_uso = true;
        $maquinaDisponible->save();

        $client = Client::findOne(function($r) use ($req) {
            return $r->codigo == $req->input('cliente');
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
            "maquina" => $maquinaDisponible->id,
            "cliente" => $client->id,
            "inicio" => Carbon::now(),
            "fin" => Carbon::now()->addMinutes($req->input("tiempo"))
        ]);

        $sessionSeconds = $session->inicio->diffInSeconds($session->fin);
        TerminateSession::dispatch($session)->delay(now()->addSeconds($sessionSeconds));

        $dailySummary = DailySummary::findOne(function($r) {
            return Carbon::parse($r->dia)->isSameDay(Carbon::now());
        });

        if (!isset($dailySummary)) {
            $dailySummary = DailySummary::create([
                'dia' => Carbon::now(),
                'totalDeSesiones' => 0,
                'totalRecaudado' => 0
            ]);
        }

        $dailySummary->totalDeSesiones += 1;
        $dailySummary->totalRecaudado += $session->obtenerAbono();
        $dailySummary->save();

        return response()
            ->view('sessions.created', [
                'status' => 'success',
                'message' => 'Sesión creada satisfactoriamente'
            ])
            ->header('HX-Trigger', 'session-created');
    }
}
