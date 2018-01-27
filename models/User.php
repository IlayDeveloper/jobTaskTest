<?php
namespace app\models;
use app\interfaces\Imodel;
use app\models\repositories\UserRep;
use app\models\repositories\SessionRep;
use app\services\Auth;

class User implements Imodel
{
    public $id;
    public $login;
    public $pass;
    public $firstName;
    public $lastName;
    public $mail;
    public $role;

    public function __construct($id = null, $login = null, $pass = null, $firstName = null,
    $lastName = 0, $mail = null, $role = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->role = $role;
    }

    public static function getTableName ()
    {
          return "users";
    }

    public function getCurrent()
    {
        if($userId = $this->getUserId())
        {
            return (new UserRep())->getOne($userId);
        }
        return null;
    }

    public function getUserId()
    {
        $sid = (new Auth())->getSessionId();
        if(!is_null($sid))
        {
            return (new SessionRep())->getUserIdBySid($sid);
        }
        return null;
    }

}
