<?php
namespace app\controllers;
use app\interfaces\IRender;

abstract class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $render;

    public function __construct($render = null)
    {
        $this->render = $render;
    }

    public function runAction ($action = null)
    {
        $this->action = $action ?:$this->defaultAction;
        $action = 'action' . ucfirst($this->action);
        $this->$action();
    }

    protected function renderer ($template, $params = [])
    {
        echo $this->render->render($template, $params);
    }

    public function redirect($url)
    {
        header("Location: /{$url}");
    }
}
