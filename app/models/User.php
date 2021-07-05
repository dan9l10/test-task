<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model
{
    public static $table = 'users';

    public function register($data){
        if($this->isRegisted($data['email'])){
            return false;
        }
        if (!empty($data)){
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



    private function isRegisted($mail){
        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE email = :email');
        $stmt->execute([':email'=>$mail]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return !empty($result);
    }
}