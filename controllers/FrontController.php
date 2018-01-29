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
    protected $defaultController = 'userslist';
    protected $controller;
    protected $controllerName;

    public function actionIndex ()
    {
        $rm = App::call()->Request;
        $this->controllerName = $rm->getControllerName()?:$this->defaultController;
        if(!isset(App::call()->config['CONTROLLERS'][$this->controllerName])){
            $this->render = new PhpRender();
            $error = 'Page not found!<br>Error 404!';
            $this->errorAction($error);
            return false;
        }
        $this->action = $rm->getActionName();
        $this->controller = App::call()->config['CONTROLLER_NAMESPACES'] . ucfirst($this->controllerName) . 'Controller';

        $controller = new $this->controller(new PhpRender());

        $this->checkLogin();
        $controller->runAction($this->action);
        return true;
    }

    protected function checkLogin()
    {
        session_start();
        if($this->controllerName != 'auth'){
            $success = (new Auth())->sessionStart();
            if(!$success)
            {
                $this->redirect('auth');
            }
        }
    }
}
