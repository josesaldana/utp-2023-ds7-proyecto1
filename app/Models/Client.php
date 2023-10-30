<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Carbon;

class Client extends Model {
    protected $csvFields = ['id', 'codigo', 'nombre', 'apellido', 'fuma'];
}