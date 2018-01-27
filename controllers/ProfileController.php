<?php
namespace app\controllers;
use app\models\User;

class ProfileController extends Controller
{
  public function actionIndex()
  {
      $user = (new User())->getCurrent();
      $params = get_object_vars($user);
      $template = 'profile.tpl';
      $this->renderer($template, $params);
  }
}
