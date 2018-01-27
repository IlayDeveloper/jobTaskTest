<?php
namespace app\models\repositories;
use \app\base\App;

class SessionRep extends Repository
{
    public function getUserIdBySid($sid)
    {
        $sql = "SELECT user_id FROM sessions WHERE sid=:sid";
        $params = [':sid' => $sid];
        return $this->getConnect()->fetch($sql, $params)['user_id'];
    }

    public function createNew($userId, $sid, $lastUpdate)
    {
        $this->clearSessions();
        $sql = "INSERT INTO sessions(user_id, sid, lastUpdate) VALUES(:user_id, :sid, :lastUpdate)";
        $params = [':user_id' => $userId, ':sid'=> $sid, ':lastUpdate' => $lastUpdate];
        return $this->getConnect()->execute($sql, $params);
    }
    public function updateLastTime($sid, $time)
    {
        $sql = "UPDATE sessions SET lastUpdate=:lastUpdate WHERE sid=:sid";
        $params = [':sid' => $sid, ':lastUpdate' => $time];
        return $this->getConnect()->execute($sql, $params);
    }

    public function deleteSessions($sid)
    {
        $sql = "DELETE FROM sessions WHERE sid=:sid";
        $params = [':sid' => $sid];
        return $this->getConnect()->execute($sql, $params);
    }

    public function getOneBySid($sid)
    {
        $sql = "SELECT * FROM sessions WHERE sid=:sid";
        $params = [':sid' => $sid];
        return $this->getConnect()->fetch($sql, $params);
    }

    protected function clearSessions()
    {
        $sessionLifeTime = App::call()->config['SESSION_LIFE_TIME'];
        $timeDilay = date("Y-m-d H:i:s", time() - $sessionLifeTime);
        $params = [':timeDilay' => $timeDilay];
        $sql = "DELETE FROM sessions WHERE lastUpdate<:timeDilay";
        $this->getConnect()->execute($sql, $params);
    }
}
