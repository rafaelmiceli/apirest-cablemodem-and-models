<?php

namespace App\Models;

use PDO;
use Exception;
use App\Classes\Db;

class Model
{

    protected $table;

    protected $fields;

    public function get($table, $fields, $conditions = null, $values = []) {
 
        try {

            $db = Db::getInstance();
            $conditions = !empty($conditions)? ' WHERE ' . $conditions : '';
            $sql = sprintf('SELECT %s FROM %s %s', $fields, $table, $conditions);
            
            $stm = $db->prepare($sql);
            $stm->execute($values);

            return $stm->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}
