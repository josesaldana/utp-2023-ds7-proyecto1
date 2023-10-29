<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Carbon;

class Session extends Model {
    protected $csvFields = ['id', 'maquina', 'cliente', 'inicio', 'fin'];

    public function tiempoRestante() {
        return Carbon::create($this->fin)->from(Carbon::create($this->inicio));
    }
}