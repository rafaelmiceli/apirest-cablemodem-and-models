<?php

namespace App\Models;

use App\Classes\Db;

class JsonModel
{
    protected $filename = 'models.json';

     protected $fields = [
        'vendor',
        'name',
        'soft'
    ];
 
    /**
     * reads json file
     * @param string $vendor vendor name
     * @return array
     */
    public function read() {

        try {   

            $content = file_get_contents($this->filename);

            if ($content === false) {
                die('Problemas al Abrir el Archvio');
            }

            return json_decode($content, true);


        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * saves content to File
     * @param array $content
     */
    public function save($content) {

        try {

            $content = file_put_contents($this->filename, json_encode($content, JSON_PRETTY_PRINT));

            if ($content === false) {
                die('Problemas al Abrir el Archvio');
            }

            return json_decode($content, true);

        } catch (\Exception $e) {
            print $e->getMessage();
        }

    }

    /**
     * updates file contents
     * @param json $content
     */
    public function update($content) {

        $content = file_put_contents($this->filename, json_encode($content));
    }
}
