<?php


namespace App\Controllers;


class ProfileController extends Controller
{
    public function show($id){
       $user = $this->model('user');
       $userData = $user->getById($id);

       $this->view->render('profile',$userData);
    }

}