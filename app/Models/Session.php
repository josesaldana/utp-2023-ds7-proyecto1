<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Carbon;

class Session extends Model {
    protected $csvFields = ['id', 'maquina', 'cliente', 'inicio', 'fin'];

    public function estaActiva() {
        return !Carbon::create($this->fin)->isPast();
    }

    public function tiempoRestante() {
        $diffInMinutes = Carbon::create($this->fin)->diffInMinutes(now());

        if($diffInMinutes > 0) {
            return $diffInMinutes . " min";
        } else {
            return Carbon::create($this->fin)->diffInSeconds(now()) . " seg";
        }
    }

    public function obtenerAbono() {
        $tiempoEnMinutos = Carbon::create($this->fin)->diffInMinutes($this->inicio);
        return floatval(($tiempoEnMinutos / 60) * 0.75);
    }
}