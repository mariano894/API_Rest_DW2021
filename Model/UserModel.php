<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class UserModel extends Database
{
    public function getUsers($email) //$limit)
    {		
		return $this->select1("SELECT nombre, apellido, email, nickname, sexo FROM usuario WHERE email = '$email';");
    }
}