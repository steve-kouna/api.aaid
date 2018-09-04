<?php

namespace Member\MemberBundle\Entity;

/**
 * Description of Credentials
 *
 * @author Steve KOUNA
 */
class Credentials {
    protected $login;

    protected $password;

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
