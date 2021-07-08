<?php


namespace App\Core;


use PDO;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        //$this->fill($attributes);
    }

    /**
     * Функция поиска по логину и паролю пользователя в базе данных
     * @param $email
     * @param $password
     * @return $this|null
     */
    public function findByEmailPassword($email,$password)
    {
        $userSql = $this->db->prepare("SELECT * FROM USERS WHERE email = :email");
        $userSql->execute([
            'email'=>$email,
        ]);
        $dataUser = $userSql->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password,$dataUser['pass'])){
            $objUser = $this->fill($dataUser);
        }
        return $objUser;
    }

    /**
     * Сохраняет данные в базе данных
     * @return $this
     */
    public function save()
    {
        $stmt  = $this->db->prepare("INSERT INTO users(email,pass) VALUES (:email,:pass)");
        $stmt->execute([
            "email"=>$this->email,
            "pass"=>password_hash($this->pass,PASSWORD_BCRYPT),
        ]);
        return $this;
    }

    /**
     * Заполенение свойств объекта
     * @param $attributes
     * @return $this|null
     */
    protected function fill($attributes)
    {
        if(empty($attributes)){
            return null;
        }
        $fillable = get_object_vars($this);
        foreach ($fillable as $var=>$value){
            if(!empty($attributes[$var])){
                $this->$var = $attributes[$var];
            }
        }
        return $this;
    }

    /**
     * Поиск по id
     * @param $id
     * @return $this|null
     */
    public function getById($id)
    {
        $userSql = $this->db->prepare("SELECT * FROM USERS WHERE id = :id");
        $userSql->execute([
            'id'=>$id,
        ]);
        $dataUser = $userSql->fetch(PDO::FETCH_ASSOC);
        $usersCollection = $this->fill($dataUser);
        return $usersCollection;
    }

}