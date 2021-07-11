<?php


namespace App\Controllers;


use App\Core\Response;
use App\Core\Session;
use App\Exceptions\AuthException;
use App\Exceptions\RegisterException;
use App\Models\User;
use http\Header;


class AuthController extends Controller
{
    /**
     * Отображение страницы входа
     */
    public function pageLogin()
    {
        $userId = User::isLogin();
        if($userId){
            header('Location: /profile/'.$userId);
        }
        $this->view->render('auth/login','',Session::flush('error'));
    }

    /**
     * Вызов метода авторизации
     */
    public function login()
    {
        $user = $this->model('user');
        $data = [
            'email'=>$this->request->email,
            'pass'=>$this->request->password,
        ];
        try {
            $user = $user->login($data);
            header('Location: /profile/'.$user->id);
        }catch (AuthException $exception){
            $session = new Session();
            $session->set('error',[$exception->getMessage()]);
            header('Location: /login');
        }
    }

    /**
     * Отображение страницы регистрации
     */
    public function pageRegister()
    {
        $userId = User::isLogin();
        if($userId){
            header('Location: /profile/'.$userId);
        }
        $this->view->render('auth/register','',Session::flush('error'));
    }

    /**
     * Вызов метода регистрации
     */
    public function register()
    {
        $session = new Session();
        $user = $this->model('user');
        $data = [
            'pass' => $this->request->password,
            'confirm_pass'=>$this->request->confirmPassword,
            'email'=>$this->request->email,
        ];
        try {
            $result = $user->register($data);
            $session->set('error',["Registration completed"]);
            header('Location: /register');
        }catch (RegisterException $exception){
            $session->set('error',[$exception->getMessage()]);
            header('Location: /register');
        }
    }

    /**
     * Удаление данных сеанса
     */
    public function logout()
    {
        $userId = User::isLogin();
        if($userId){
            header('Location: /');
        }
        $user = $this->model('user');
        $user->logout();
        header('Location: /');
    }

}