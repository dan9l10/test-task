<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Model;
use App\Core\Session;
use App\Exceptions\AuthException;
use App\Exceptions\RegisterException;
use PDO;

class User extends Model
{
    public static $table = 'users';
    public $email;
    public $pass;
    public $id;

    /**
     * Функция регистрации пользователя
     * @param $data
     * @return User
     * @throws RegisterException
     */
    public function register($data)
    {
        if (!empty($data)){
            $password = trim($data['pass']);
            $passwordConfirm = trim($data['confirm_pass']);

            if($this->isRegistered($data['email'])){
                throw new RegisterException('This email exist already');
            }
            if ($password === $passwordConfirm){
                $this->email = $data['email'];
                $this->pass = $password;
                $status = $this->save();
            }else{
                throw new RegisterException('Password is not confirmed');
            }
        }else{
            throw new RegisterException('Data is empty');
        }
        return $status;
    }

    /**
     * Функция проверки зарегестрирован ли пользователь в системе
     * @param $mail
     * @return bool
     */
    private function isRegistered($mail)
    {
        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE email = :email');
        $stmt->execute([':email'=>$mail]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return !empty($result);
    }

    /**
     * @param $data
     * @return User | null
     * @throws AuthException
     */
    public function login($data)
    {
        if (!empty($data)){
            $userData = $this->findByEmailPassword($data['email'],$data['pass']);
            if(empty($userData)){
                throw new AuthException("Invalid email or password");
            }
            $session = new Session();
            $session->set('user',[
                'email'=>$userData->email,
                'id'=>$userData->id,
            ]);
            return $userData;
        }
        return null;
    }

    /**
     * Удаление данных сесии
     */
    public function logout(){
        $session = new Session();
        $session->destroy();
    }

    /**
     * Проверяет авторизован ли пользователь
     * @return false|mixed
     */
    public static function isLogin()
    {
        $session = new Session();
        $sessionUser = $session->get('user');
        if ($sessionUser){
            return $sessionUser['id'];
        }
        return false;
    }
}