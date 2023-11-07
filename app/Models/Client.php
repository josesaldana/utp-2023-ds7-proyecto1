<?php

namespace App\Models;

use App\Models\Model;

class Client extends Model {
    protected $csvFields = ['id', 'codigo', 'nombre', 'apellido', 'fuma'];
}