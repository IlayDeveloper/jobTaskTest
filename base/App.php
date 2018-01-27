<?php
namespace app\base;
require "../traits/SingleTon.php";

class ComponentNotFoundExeption extends \Exception {}
/**
 *
 */
class App
{
  use \app\traits\SingleTon;

  public $config;
  private $instances;

  function __construct()
  {
    # code...
  }

  public function call ()
  {
      return App::getInstance();
  }

  public function run ()
  {
      $this->config = include "../config/main.php";
      $this->autoLoader();
      $this->instances = new \app\base\Storage ();
      App::call()->mainController->runAction();
  }

  private function autoLoader()
  {
      require "../services/AutoLoader.php";
      spl_autoload_register([new \app\services\AutoLoader(), "loadClass"]);
  }

  function __get($className)
  {
      return $this->instances->get($className);
  }

  public function createInstance($name)
  {
      if (isset($this->config['classes'][$name]))
      {
          $params = $this->config['classes'][$name];
          $className = $params['class'];
          unset($params['class']);
          $reflection = new \ReflectionClass($className);
          return $reflection->newInstanceArgs($params);
      }

      throw new ComponentNotFoundExeption("Component not found!");

  }

}
