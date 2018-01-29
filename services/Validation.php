<?php
namespace app\services;


class Validation
{

    public function validateUser($user)
    {
        $patternName = "/(^[a-zA-Z]{2,50}$)/";
        $patternLogin = "/(^[\.\-_a-zA-Z0-9]{3,15}$)/";
        $patternPass = "/(^[\._a-zA-Z0-9]{6,30}$)/";
        $patternMail = "/(^[\._a-zA-Z0-9]{1,100}@[_\-a-zA-Z0-9]{1,100}\.[a-zA-Z0-9]{2,}$)/";
        $matches = [];
        $errors = [];
        $result = [];

        preg_match($patternName, $user->firstName, $matches['firstName']);
        preg_match($patternName, $user->lastName, $matches['lastName']);
        preg_match($patternLogin, $user->login, $matches['login']);
        preg_match($patternPass, $user->pass, $matches['pass']);
        preg_match($patternMail, $user->mail, $matches['mail']);

        foreach ($matches as $key => $value) {
            if(empty($value)){
                $errors[] = $key;
            }
        }

        if(!empty($errors)){
            $result['status'] = false;
            $result['errors'] = $errors;
        }else{
            $result['status'] = true;
            $user->pass = $this->getHash($user->pass);
            $result['user'] = $user;
        }
        return $result;
    }

    public function getHash($password, $algo = PASSWORD_DEFAULT)
    {
        return password_hash($password, $algo);
    }

    public function passVerify($pass, $hash)
    {
        return password_verify($pass, $hash);
    }
}
