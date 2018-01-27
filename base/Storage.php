<?php
namespace app\base;

class Storage
{
    protected $items = [];

    public function get ($className)
    {
        if(isset($this->items[$className])){
            return $this->items[$className];
        }else
        {
            $this->items[$className] = App::call()->createInstance($className);
            return $this->items[$className];
        }
    }

    public function set ($instance, $className)
    {
        $this->$items[$className] = $instance;
    }
}
