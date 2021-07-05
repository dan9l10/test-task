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
        $user = $this->model('user');
        $user->email = $this->request->email;
        $user->pass = $this->request->password;
        $user->save();


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

        $user->login($data);
    }

}