<?php
namespace app\models\repositories;
use app\models\User;

class UserRep extends Repository
{
  protected $entityClass = User::class;
  protected $tableName;

  public function __construct ()
  {
      $this->tableName = User::getTableName();
  }

  public function getByLoginPass($login, $password)
  {
      $sql = "SELECT * FROM users WHERE login = :login AND pass = :password";
      $params = [':login' => $login, ':password' => $password];
      $class = $this->entityClass;
      return $this->getConnect()->fetchObject($sql, $params, $class);
  }
}
