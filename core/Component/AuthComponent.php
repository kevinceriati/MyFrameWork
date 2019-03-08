<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 08/03/2019
 * Time: 16:00
 */

namespace Core\Component;


use core\Request;

class AuthComponent
{
    static public function checkAuthenticated(){
        if (!isset($_SESSION['is_connected'])){
            return false;
        }

        return true;
    }

    static  public function create(Request $request){

        $email = 'kevin@gmail.com';
        $password = '1234';
        if (!empty($request->getPost())){
            if (($request->getPost('email') === $email) && ($request->getPost('password') === $password)) {
            $_SESSION['is_connected'] = true;
            }
    }}
    static  public function delete(){
        session_destroy();
    }
}