<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-17
 * Time: 4:39 PM
 */
class UserMgr extends DBMgr
{
    function __construct()
    {
        parent::__construct('users');
    }

    function getUser(string $username)
    {
        $username = $this->db->escape_string($username);
        return new User(Util::queryW($this->db, "SELECT id FROM users WHERE username='$username'")->fetch_assoc()['id']);
    }

    function login(string $username, string $password)
    {
        $user = $this->getUser($username);
        if ($user->checkPassword($password))
            return $user;
        throw new Exception('Invalid login', Constants::ERR_LOGIN);
    }

    function createUser(string $username, string $password, string $type)
    {
        $password = password_hash($password, Constants::PASS_HASH);
        Util::queryW($this->db, "INSERT INTO users (username, password, type) VALUES ('$username', '$password', '$type')");
        return new User(Util::getLastID($this->db));
    }

    function listUsers(){
        $sqlRes = Util::queryW($this->db, "SELECT id FROM users");
        $res = [];
        while ($row = $sqlRes->fetch_assoc())
            $res[] = new User($row['id']);
        return $res;
    }
}