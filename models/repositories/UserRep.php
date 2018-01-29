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

  public function getByLogin($login)
  {
      $sql = "SELECT * FROM users WHERE login = :login";
      $params = [':login' => $login];
      $class = $this->entityClass;
      return $this->getConnect()->fetchObject($sql, $params, $class);
  }

  public function getAllSort($column, $direction='DESC')
  {
      $sql = "SELECT * FROM {$this->tableName} ORDER BY {$column} {$direction}";
      return $this->getConnect()->fetchAll($sql);
  }

  public function getByLiterals($column, $literals, $columnOrder, $direction='')
  {
      $sql = "SELECT * FROM {$this->tableName} WHERE {$column} LIKE :literals";
      $params =[':literals' => '%'.$literals.'%'];
      if($columnOrder !='none'){
            $sql = "SELECT * FROM {$this->tableName} WHERE {$column} LIKE :literals ORDER BY {$columnOrder} {$direction}";
      }
      return $this->getConnect()->fetchAll($sql, $params);
  }
}
