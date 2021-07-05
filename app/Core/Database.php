<?php


namespace App\Core;


use PDO;

class Database
{
    private $db;

    public function __construct()
    {
        $this->db = $this->connection();
    }


    /**
     * @return PDO
     */
    private function connection(){
        try {
            return new \PDO('mysql:host=localhost;dbname=newtone','root','');
        }catch (\PDOException $e){
            throw new \PDOException($e->getTraceAsString());
        }
    }

    /**
     * @param $sql
     * @return PDO
     */
    public function getConnection(){
        return $this->db;
    }

}