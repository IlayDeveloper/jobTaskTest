<?php
namespace app\interfaces;

interface IRender
{
  public function render ($template, $params = []);
}
