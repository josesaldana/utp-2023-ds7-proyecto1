<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

abstract class Model {
    use ModelCSVDataAccess;

    private $data = array();
    protected $csvFields = array();

    public function __construct($data = array()) {
        $this->data["id"] = Uuid::uuid4();
        $this->hydrate(array_combine($this->csvFields, $data));
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    public function __isset($name) {
        return isset($this->data[$name]);
    }

    public function __unset($name) {
        unset($this->data[$name]);
    } 

    private function hydrate(array $data) {
        foreach($this->csvFields as $csvField) {
            if (array_key_exists($csvField, $data)) {
                $this->$csvField = $data[$csvField];
            } else {
                $this->$csvField = null;
            }
        }
    }
}

/*
 * CSV Data Access for models using fgetcsv and fputcsv. It could be replaced
 * with league/csv.
 */
trait ModelCSVDataAccess {

    public static function findAll() {
        $results = [];
        $handle = fopen(self::getCSVFileName(), "a+");

        while(($row = fgetcsv($handle)) != false) {
            $class = get_called_class();
            $obj = new $class($row);
            array_push($results, $obj);
        }

        fclose($handle);

        return $results;
    }

    private static function getCSVFileName() {
        $class = (new \ReflectionClass(get_called_class()))->getShortName();
        return strtolower(Str::plural($class)) . ".csv";
    }
}