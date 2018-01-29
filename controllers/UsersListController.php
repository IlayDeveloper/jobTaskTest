<?php
namespace app\controllers;
use app\models\repositories\UserRep;

class UsersListController extends Controller
{
    public function actionIndex()
    {
        $template = 'usersList.tpl';
        $rep = new UserRep();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['columnSearch'] != 'none'){
                $allUsers = $rep->getByLiterals($_POST['columnSearch'], $_POST['enter'], $_POST['columnSort'], $_POST['sort']);
            }elseif($_POST['columnSort'] != 'none'){
                $allUsers = $rep->getAllSort($_POST['columnSort'], $_POST['sort']);
            }else{
                $allUsers = $rep->getAll();
            }
        }else{
            $allUsers = $rep->getAll();
        }
        //формируем таблицу для рендера
        $table = "<table><tr><td></td><td>Id</td><td></td><td>Login</td><td></td><td>Firstname</td><td></td><td>Lastname</td><td></td><td>Mail</td>";
        foreach ($allUsers as $user) {
            $table .= "<tr><td><a href=/profile/check?id={$user['id']}>Check profile</a></td>";
            unset($user['pass']);
            unset($user['role']);
            foreach ($user as $key => $value) {
                $table .= '<td>' . $value . '<td>';
            }
        }
        $params['table'] = $table;
        $this->renderer($template, $params);
    }

}
