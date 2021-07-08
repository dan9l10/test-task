<?php


namespace App\Controllers;


use App\Core\Response;
use App\Models\User;
use http\Header;


class AuthController extends Controller
{
    public function pageLogin()
    {
        $userId = User::isLogin();
        if($userId){
            header('Location: /profile/'.$userId);
        }
        $this->view->render('auth/login');
    }

    public function pageRegister()
    {
        $userId = User::isLogin();
        if($userId){
            header('Location: /profile/'.$userId);
        }
        $this->view->render('auth/register');
    }

    public function register()
    {
        $user = $this->model('user');
        $user->email = $this->request->email;
        $user->pass = $this->request->password;
        $result = $user->save();
        if (is_null($result)){
            header('Location: /');
        }

        /*if(!empty($this->request)){
            $data = [
                'email'=>$this->request->email,
                'pass'=>$this->request->password,
                'confirm_pass'=>$this->request->confirmPassword
            ];
            $user = $this->model('user');
            $status = $user->register($data);

            if ($status){
                header('Location: /');
            }else{
                header('Location: /register');
            }
        }*/
    }
    public function login()
    {
        $user = $this->model('user');
        $data = [
            'email'=>$this->request->email,
            'pass'=>$this->request->password,
        ];

        $user = $user->login($data);
        if (!empty($user)){
            header('Location: /profile/'.$user->id);
        }else{
            header('Location: /');
        }
    }
    public function logout()
    {
        $user = $this->model('user');
        $user->logout();
        header('Location: /register');
    }

}