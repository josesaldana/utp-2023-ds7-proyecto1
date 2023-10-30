<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

abstract class Model {
    use ModelCSVDataAccess;

    protected $data = array();
    protected $csvFields = array();

    public function __construct($data = array()) {
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
 * ModelCSVDataAccess
 * 
 * CSV Data Access for models using fgetcsv and fputcsv. 
 * It can be replaced with an implementation using league/csv package.
 */
trait ModelCSVDataAccess {
    public static function create($data = array()) {
        array_unshift($data, Uuid::uuid4());

        $class = get_called_class();
        $obj = new $class($data);

        $handle = fopen(self::getCSVFileName(), "a+");
        fputcsv($handle, array_values($obj->data));
        fclose($handle);

        return $obj;
    }

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

    public function save() {
        $csvFilename = self::getCSVFileName();
        $temporaryFileName =  $csvFilename . '.tmp';

        $input = fopen($csvFilename, "r");
        $output = fopen($temporaryFileName, "w");

        while(($row = fgetcsv($input)) != false) {
            $class = get_called_class();
            $obj = new $class($row);
            $newRowData = $obj->id == $this->id ? $this->data : $row;
            fputcsv($output, $newRowData);
        }

        fclose($input);
        fclose($output);

        unlink($csvFilename);
        rename($temporaryFileName, $csvFilename);
    }  

    private static function getCSVFileName() {
        $class = (new \ReflectionClass(get_called_class()))->getShortName();
        return strtolower(Str::plural($class)) . ".csv";
    }
}