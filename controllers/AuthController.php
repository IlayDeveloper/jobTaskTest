<?php
namespace app\controllers;
use app\services\Auth;
use app\models\User;

class AuthController extends Controller
{
    public function actionIndex()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['login'];
            $password = $_POST['password'];
            $success = (new Auth())->login($login, $password);
            if($success){
                $this->redirect('profile');
            }
        }
        $template = 'loginForm.tpl';
        $this->renderer($template);
        // $sessionLifeTime = \app\base\App::call()->config['SESSION_LIFE_TIME'];
        // $timeDilay = date("Y-m-d H:i:s", time() - $sessionLifeTime);
        // var_dump($timeDilay);
    }

    public function actionSignup()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = null;
            extract($_POST);
            $user = new User($id, $login, $password, $firstName, $lastName, $mail);
            $success = (new Auth())->signup($user);
            if($success){
                $this->redirect('profile');
            }
        }
        $template = 'signupForm.tpl';
        $this->renderer($template);
    }

    public function actionLogout()
    {
        (new Auth())->logout();
        $this->redirect('profile');
    }
}
