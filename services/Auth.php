<?php
namespace app\services;
use app\models\repositories\SessionRep;
use app\models\repositories\UserRep;
use app\models\User;
use app\base\App;

class Auth
{
    public function login($login, $pass)
    {
        $login = $this->validateString($login);
        $pass = $this->validateString($pass);
        $user = (new UserRep())->getByLoginPass($login, $pass);
        if(!$user){
            return false;
        }
        $this->openSession($user);
        return true;
    }

    public function logout()
    {
        (new SessionRep())->deleteSessions($_SESSION['sid']);
        $this->sessionDestroy();
        // unset($_SESSION['sid']);
        return true;
    }

    public function signup(User $user)
    {
        $user = $this->validateUser($user);
        $rep = new UserRep();
        $rep->create($user);
        $user = $rep->getByLoginPass($user->login, $user->pass);
        $this->openSession($user);
        return true;
    }

    public function getSessionId()
    {
        $sid = $_SESSION['sid'];
        if(!is_null($sid)){
            $time = date('Y-m-d H:i:s');
            (new SessionRep())->updateLastTime($sid, $time);
        }
        return $sid;
    }

    public function openSession($user)
    {
        $sid = $this->generateSid();
        $timeLast = date("Y-m-d H:i:s");
        (new SessionRep())->createNew($user->id, $sid, $timeLast);
        $_SESSION['sid'] = $sid;
        $_SESSION['lastRegen'] = time();
    }

    protected function generateSid($length = 10)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';
        $sid = '';
        while(strlen($sid) < $length){
            $sid .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $sid;
    }

    protected function validateString($str)
    {
        return $str;
    }
    protected function validateUser($user)
    {
        return $user;
    }

    public function sessionStart()
    {
        //проверить валидность sid, если есть. Если нет - вернуть false.
        //проверить время обновления id сессии и создать новый, если истек срок
        $currentTime = time();
        $sid = $_SESSION['sid'];
        $sessionLifeTime = App::call()->config['SESSION_LIFE_TIME'];
        $sessionRegenTime = App::call()->config['SESSION_REGENERATE_ID_TIME'];

        $rep = new SessionRep();
        $session = $rep->getOneBySid($sid);
        if(!$session){
            return false;
        }
        if($session['lastUpdate'] < date('Y-m-d H:i:s', ($currentTime - $sessionLifeTime))){
            $this->logout();
            return false;
        }else{
            $rep->updateLastTime($sid, date('Y-m-d H:i:s'));
        }
        //регенирируем id сессии(рассмотреть другие варианты для нестабльного соединения)
        if($_SESSION['lastRegen'] < ($currentTime - $sessionRegenTime)){
            session_regenerate_id(true);
            $_SESSION['lastRegen'] = $currentTime;
        }
        return true;
    }

    public function sessionDestroy()
    {
        if(session_status() == PHP_SESSION_ACTIVE){
            session_unset();
            setcookie(session_name(), session_id(), time()-60*60*24);
            session_destroy();
            return true;
        }
        return false;
    }
}
