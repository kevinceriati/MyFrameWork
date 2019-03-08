<?php

namespace App\Controller;



use Core\Component\AuthComponent;
use core\Request;

class UsersController extends AppController
{


    public function index()
    {
        AuthComponent::checkAuthenticated();
        if(AuthComponent::checkAuthenticated() === false) {
        $this->redirect('login');
        }else{
            $this->render('index');
        }
        }



    public function login()
    {
        AuthComponent::create($this->request);
        if(!empty($_SESSION)){
        if ($_SESSION['is_connected'] === true){
        $this->redirect('index');
        }}

        $this->render('login');
    }

    public function logout()
    {

       AuthComponent::delete();
        $this->redirect('login');

    }

}