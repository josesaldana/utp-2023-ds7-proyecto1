<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Carbon;

class DailySummary extends Model {
    protected $csvFields = ['id', 'dia', 'totalDeSesiones', 'totalRecaudado'];
}