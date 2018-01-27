<?php
namespace app\traits;
/**
 *
 */
trait SingleTon
{
  private static $instance = null;

  function getInstance()
  {
    if(is_null(static::$instance)){
        static::$instance = new static ();
    }
    return static::$instance;
  }
}
