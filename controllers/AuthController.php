<?php
namespace app\controllers;
use app\services\Auth;
use app\models\User;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $params = [];
        $params ['errors'] = '';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login = $_POST['login'];
            $password = $_POST['password'];
            $success = (new Auth())->login($login, $password);
            $params ['errors'] = 'Неверный логин или пароль!';
            if($success){
                $this->redirect('profile');
            }
        }
        $template = 'loginForm.tpl';
        $this->renderer($template, $params);
    }

    public function actionSignup()
    {
        $params = [];
        $params ['errors'] = '';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = null;
            $role = 0;
            extract($_POST);
            $user = new User($id, $login, $password, $firstName, $lastName, $mail, $role);
            $result = (new Auth())->signup($user);

            if($result['status']){
                $this->redirect('profile');
            }
            $error = "Следующие поля заполнены некорректно:<br>";
            foreach ($result['errors'] as $value) {
                $error .= "<br>{$value}";
            }
            $params ['errors'] = $error;
        }
        $template = 'signupForm.tpl';
        $this->renderer($template, $params);
    }

    public function actionLogout()
    {
        (new Auth())->logout();
        $this->redirect('profile');
    }
}
