<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Session;
use App\Models\Machine;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    public function index() {
        return view('reports.index');
    }

    public function generate(Request $req) {
        if ($req->input('reporte') == "clientes") {
            return $this->generarReporteDeClientes();
        } else if ($req->input("reporte") == "financiero") {
            return $this->generarReporteDeFinanciero();
        }
    }

    private function generarReporteDeClientes() {
        $clientes = Client::findAll();

        $fumadores = 0;
        $nofumadores = 0;
        $copiasDeClientes = [];

        for ($i = 0; $i < count($clientes); $i++) {
            $copiaDeCliente = $clientes[$i]->asArray();

            // Cantidad de Horas Alquiladas
            $sesionesDelCliente = Session::findMany(function($s) use($clientes, $i) {
                return $s->cliente == $clientes[$i]->id;
            });

            $copiaDeCliente['horasAlquiladas'] = $this->obtenerHorasAlquiladas($sesionesDelCliente);
            $copiaDeCliente['maquinasUtilizadas'] = join(', ', $this->obtenerMaquinasUtilizdas($sesionesDelCliente));

            array_push($copiasDeClientes, $copiaDeCliente);
            
            // Resumen de fumadores / no fumadores
            if ($clientes[$i]->fuma) {
                $fumadores += 1;
            } else {
                $nofumadores += 1;
            }
        }

        return view('reports.clientes', [
            'clientes' => $copiasDeClientes,
            'fumadores' => $fumadores,
            'nofumadores' => $nofumadores,
        ]);
    }

    private function generarReporteDeFinanciero() {
        $clientes = Client::findAll();

        $copiasDeClientes = [];
        $totalRecaudado = 0;

        for ($i = 0; $i < count($clientes); $i++) {
            $copiaDeCliente = $clientes[$i]->asArray();

            // Cantidad de Horas Alquiladas
            $sesionesDelCliente = Session::findMany(function($s) use($clientes, $i) {
                return $s->cliente == $clientes[$i]->id;
            });

            $copiaDeCliente['horasAlquiladas'] = $this->obtenerHorasAlquiladas($sesionesDelCliente);
            $copiaDeCliente['totalGenerado'] = $this->obtenerTotalGenerado($sesionesDelCliente);

            array_push($copiasDeClientes, $copiaDeCliente);
            $totalRecaudado += $copiaDeCliente['totalGenerado'];
        }

        return view('reports.financiero', [
            'clientes' => $copiasDeClientes,
            'totalRecaudado' => $totalRecaudado
        ]);
    }

    private function obtenerHorasAlquiladas($sesiones) {
        $minutosAlquilados = 0;

        foreach ($sesiones as $session) {
            $minutosAlquilados += Carbon::parse($session->fin)->diffInMinutes(Carbon::parse($session->inicio));
        }

        return $minutosAlquilados / 60;
    }

    private function obtenerMaquinasUtilizdas($sesiones) {
        $maquinasIds = array_map(function($s) { return $s->maquina; }, $sesiones);

        $maquinas = Machine::findMany(function($m) use ($maquinasIds) {
            return in_array($m->id, $maquinasIds);
        });

        return array_map(function($m) { return $m->numero; }, $maquinas);
    }

    private function obtenerTotalGenerado($sesiones) {
        $totalGenerado = 0;

        foreach($sesiones as $sesion) {
            $minutos = Carbon::parse($sesion->fin)->diffInMinutes(Carbon::parse($sesion->inicio));
            $totalGenerado += ($minutos / 60) * 0.75;
        }

        return $totalGenerado;
    }
}
