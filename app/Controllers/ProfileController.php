<?php


namespace App\Controllers;


use App\Core\Request;
use App\Models\User;

class ProfileController extends Controller
{

    public function show($id){
        $userId = User::isLogin();
        if (!$userId){
            header('Location: /login');
        }elseif ($userId !== $id){
            header('Location: /profile/'.$userId);
        }
       $user = $this->model('user');
       $userData = $user->getById($id);

       $this->view->render('profile',$userData);
    }

}