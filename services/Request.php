<?php


namespace app\services;



class Request
{
    private $requestString;
    private $params;

    private $controllerName;
    private $actionName;

    private $patterns = [
        "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui"
    ];

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }


    private function parseRequest()
    {
        foreach ($this->patterns as $pattern){
            if(preg_match_all($pattern, $this->requestString, $matches)){
                $this->controllerName = $matches['controller'][0];
                $this->actionName = $matches['action'][0];

                if(!empty($_REQUEST)){
                    $this->params = $_REQUEST;
                    foreach (explode("&", $matches['params'][0]) as $param){
                        $p = explode("=",$param);
                        if(!empty($p[0])){
                          $this->params[$p[0]] = $p[1];
                        }

                    }
                }
                return;
            }
        }

    }

    public function getControllerName()
    {
        return strtolower($this->controllerName);
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }
}
