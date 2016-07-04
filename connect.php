<?php

class MyPass{
    protected $host="localhost";
    protected $userName="novirusc_novir";
    protected $password="NoVirus@1";
    protected $database="novirusc_NOD32";

    public function getPass(){
        return $this->password;
    }
    public function getName(){
        return $this->userName;
    }
}

$pass= new MyPass();


?>