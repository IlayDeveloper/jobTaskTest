<?php
namespace app\services;
use app\base\App;

class AutoLoader
{
  public function loadClass ($className)
  {
      // throw new \Exception("Go go go");
      $path = str_replace('app', App::call()->config['ROOT_DIR'], $className);
      $path = str_replace('\\', '/', $path);
      include $path . '.php';

  }
}
