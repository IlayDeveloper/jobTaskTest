<?php
return [
  'ROOT_DIR' => $_SERVER['DOCUMENT_ROOT'] . "\..\\",
  'TEMPLATES_DIR' => $_SERVER['DOCUMENT_ROOT'] . "\..\\views\\",
  'CONTROLLER_NAMESPACES' => 'app\controllers\\',
  'SESSION_LIFE_TIME' => 60*20,
  'SESSION_REGENERATE_ID_TIME' => 60*2,

  'classes' => [
      'mainController' => [
          'class' => app\controllers\FrontController::class,
      ],
      'db' => [
          'class' => app\services\Db::class,
          'driver' => 'mysql',
          'host' => 'localhost',
          'dbname' => 'job_test',
          'charset' => 'UTF8',
          'login' => 'root',
          'pass' => '',
      ],
      'Request' => [
          'class' => app\services\Request::class,
      ]
  ]
];
