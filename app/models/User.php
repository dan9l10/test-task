<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model
{
    public static $table = 'users';
    public $email;
    public $pass;

    public function register($data){
        if (!empty($data)){
            if($this->isRegisted($data['email'])){
                return false;
            }
            if ($data['pass'] === $data['confirm_pass']){
                array_pop($data);
                $status = $this->db->prepare('INSERT INTO users(email,pass) VALUES (:email,:pass)');
                $status->execute($data);
            }else{
                throw new \Exception('Password is not confirmed');
            }
        }else{
            throw new \Exception('Data is empty');
        }
        return $status;
    }

    /**
     * @param $data
     */
    public function login($data){
        if (!empty($data)){
            $userSql = $this->db->prepare("SELECT * FROM USERS WHERE email = :email and pass = :pass");
            $userSql->execute([
                'email'=>$data['email'],
                'pass'=>$data['pass'],
                ]);
            $dataUser = $userSql->fetch(PDO::FETCH_ASSOC);
            $usersCollection = $this->fill($dataUser);
            d($usersCollection);

        }
    }

    /**
     *
     */
    public function save(){
        $stmt  = $this->db->prepare("INSERT INTO users(email,pass) VALUES (:email,:pass)");
        $stmt->execute([
            "email"=>$this->email,
            "pass"=>$this->pass,
            ]);
    }



    private function isRegisted($mail){
        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE email = :email');
        $stmt->execute([':email'=>$mail]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return !empty($result);
    }
}