<?php
namespace app\services;

class Db
{
    protected $connect = null;

    protected $config;

    public function __construct ($driver, $host, $dbname, $charset, $login, $pass)
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['dbname'] = $dbname;
        $this->config['charset'] = $charset;
        $this->config['login'] = $login;
        $this->config['pass'] = $pass;
    }

    protected function getConnect ()
    {
      if (is_null($this->connect))
      {
          $this->connect = new \PDO($this->prepareDsn(), $this->config['login'], $this->config['pass']);
          $this->connect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
          $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      }
      return $this->connect;
    }
    protected function query ($sql, $params)
    {
      $PDOStatement = $this->getConnect()->prepare($sql);
      $PDOStatement->execute($params);
      return $PDOStatement;
    }

    public function execute ($sql, $params = [])
    {
      return $this->query($sql, $params);
    }

    public function fetchAll ($sql, $params = [])
    {
      return $this->query($sql, $params)->fetchAll();
    }

    public function fetch ($sql, $params = [])
    {
      return $this->query($sql, $params)->fetch();
    }

    public function fetchObject($sql, $params = [], $class)
    {
      $result = $this->query($sql, $params);
      $result->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
      return $result->fetch();
    }

    protected function prepareDsn ()
    {
      return $dsn = "{$this->config['driver']}:
      host={$this->config['host']};
      dbname={$this->config['dbname']};
      charset={$this->config['charset']}";
    }
}
