<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    public function getUsers($email) //$limit)
    {
		//$user_email = 'lesbiacano1@outlook.com';
        //return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
		return $this->select1("SELECT * FROM users WHERE user_email = '$email';");
    }
}