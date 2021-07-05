<?php


namespace App\Controllers;


use App\Models\User;
use http\Header;


class AuthController extends Controller
{
    public function pageLogin()
    {
        $this->view->render('auth/login');
    }

    public function pageRegister()
    {
        $this->view->render('auth/register');
    }

    public function register()
    {
        if(!empty($this->request)){
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
        }
    }
    public function login()
    {
        echo "request";
    }

}