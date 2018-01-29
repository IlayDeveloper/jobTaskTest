<?php
namespace app\controllers;
use app\models\User;
use app\models\repositories\UserRep;
use app\base\App;
use app\services\Validation;

class ProfileController extends Controller
{
  public function actionIndex()
  {
      $user = (new User())->getCurrent();
      $params = get_object_vars($user);
      $template = 'profile.tpl';
      $this->renderer($template, $params);
  }

  public function actionCheck()
  {
      $rm = App::call()->Request;
      $variable = $rm->getParams();
      $user = (new UserRep())->getOne($variable['id']);
      if(!$user){
          $this->redirect('usersList');
      }
      $params = get_object_vars($user);
      $template = 'profile.tpl';
      $this->renderer($template, $params);
  }

  public function actionChange()
  {
      $rm = App::call()->Request;
      $variable = $rm->getParams();
      $user = (new User())->getCurrent();
      if($user->role || ($variable['id'] == $user->id)){
          $changingUser = (new UserRep())->getOne($variable['id']);
          $params = get_object_vars($changingUser);
          $params['errors'] = '';
          $template = 'changeProfile.tpl';
      }else{
          $params['error'] = 'У вас недостаточно прав!';
          $template = 'error.tpl';
      }
      $this->renderer($template, $params);
  }

  public function actionSave()
  {
      $params = [];
      $params ['errors'] = '';
      $template = 'changeProfile.tpl';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $rm = App::call()->Request;
          $variable = $rm->getParams();
          extract($_POST);
          $user = new User($variable['id'], $login, $password, $firstName, $lastName, $mail);
          $result = (new Validation())->validateUser($user);

          if($result['status']){
              (new UserRep())->update($user);
              $this->redirect("profile/check?id={$user->id}");
          }

          $error = "Следующие поля заполнены некорректно:<br>";
          foreach ($result['errors'] as $value) {
              $error .= "<br>{$value}";
          }
          $user = (new UserRep())->getOne($variable['id']);
          $params = get_object_vars($user);
          $params ['errors'] = $error;
      }else{
        $params['error'] = 'У вас недостаточно прав!';
        $template = 'error.tpl';
      }
      $this->renderer($template, $params);
  }
}
