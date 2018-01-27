<?php
namespace app\models\repositories;
use app\interfaces\Imodel;

abstract class Repository
{

    protected $connect = null;
    protected $entityClass;
    protected $tableName;

    //crud
    public function create(Imodel $object)
    {
        $prepareSql = $this->prepareSql($object);
        $sql = "INSERT INTO {$this->tableName} SET {$prepareSql}";
        $this->getConnect()->execute($sql);
    }

    public function getOne($id)
    {
        $class = $this->entityClass;
        $sql = "SELECT * FROM {$this->tableName} WHERE id=:id";
        $params = [':id' => $id];
        return $this->getConnect()->fetchObject($sql, $params, $class);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->getConnect()->fetchAll($sql);
    }

    public function update(Imodel $object)
    {
        $id = $object->id;
        $prepareSql = $this->prepareSql($object);
        $sql = "UPDATE {$this->tableName} SET {$prepareSql} WHERE id=:id";
        $params = [':id' => $id];
        $this->getConnect()->execute($sql, $params);
    }

    public function delete(Imodel $object)
    {
        $id = $object->id;
        $sql = "DELETE FROM {$this->tableName} WHERE id=:id";
        $params = [':id' => $id];
        $this->getConnect()->execute($sql, $params);
    }

    protected function prepareSql($object)
    {
        $prepareString = "";
        $property = get_object_vars($object);

        foreach ($property as $key => $value) {
          if($key != 'id'){
            $prepareString = "{$prepareString} {$key} = '{$value}',";
          }
        }
        return substr($prepareString, 0, -1);
    }

    protected function getConnect()
    {
        if(is_null($this->connect))
        {
            $this->connect = \app\base\App::call()->db;
        }
        return $this->connect;
    }
}
