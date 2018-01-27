<?php
namespace app\controllers;
use app\base\App;
use app\models\repositories\UserRep;
use app\services\Request;
use app\services\Auth;
use app\services\renderers\PhpRender;
use app\models\User;

class FrontController extends Controller
{
    protected $defaultController = 'profile';
    protected $controller;
    protected $controllerName;

    public function actionIndex ()
    {
        $rm = App::call()->Request;
        $this->controllerName = $rm->getControllerName()?:$this->defaultController;
        $this->action = $rm->getActionName();

        $this->controller = App::call()->config['CONTROLLER_NAMESPACES'] .
          ucfirst($this->controllerName) . 'Controller';

        $this->checkLogin();


        $controller = new $this->controller(new PhpRender());

        $controller->runAction($this->action);

    }

    protected function checkLogin()
    {
        session_start();
        if($this->controllerName != 'auth'){
            // $user = (new User())->getCurrent();
            $success = (new Auth())->sessionStart();

            if(!$success)
            {
                $this->redirect('auth');
            }
        }
    }
}
