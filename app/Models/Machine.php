<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Carbon;

class Machine extends Model {
    protected $csvFields = ['id', 'numero', 'en_uso'];
}