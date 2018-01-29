<?php
namespace app\controllers;
use app\interfaces\IRender;

abstract class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $render;
    protected $layout = true;
    protected $templateLayout = 'mainLayout.tpl';

    public function __construct($render = null)
    {
        $this->render = $render;
    }

    public function runAction ($action = null)
    {
        $this->action = $action ?:$this->defaultAction;
        $action = 'action' . ucfirst($this->action);
        if(method_exists($this, $action)){
            $this->$action();
            return true;
        }
        $error = 'Page not found!<br>Error 404!';
        $this->errorAction($error);
    }

    public function errorAction($error)
    {
        $params['error'] = $error;
        $template = 'error.tpl';
        $this->renderer($template, $params);
    }

    public function redirect($url)
    {
        header("Location: /{$url}");
    }

    protected function renderer ($template, $params = [])
    {
        if($this->layout){
            echo $this->render->render($this->templateLayout, ['content' => $this->render->render($template, $params)]);
        }else{
            echo $this->render->render($template, $params);
        }
    }
}
