<?php
namespace app\services\renderers;
use app\interfaces\IRender;
use app\base\App;

class PhpRender implements IRender
{
    public function render($template, $params = [])
    {
        $templatePath = App::call()->config['TEMPLATES_DIR'] . $template;
        extract($params);
        ob_start();
        require $templatePath;
        return ob_get_clean();
    }
}
