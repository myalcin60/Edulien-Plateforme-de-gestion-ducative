<?php

abstract class User {

    private $firstName ;
    private $lastName ;
    private $password ;
    private $email ;
    private $role ;


    public function __construct(String $firstName,String $lastName,String $email,String $password,String $role)
    {
        $this ->firstName=$firstName;
        $this ->lastName=$lastName;
        $this ->email=$email;
        $this ->password=$password;
        $this ->role=$role;
    }
    
  
    
    public function getFirsName(){
        return $this->firstName;
    }
       public function getLastName(){
        return $this->lastName;
    }
       public function getEmail(){
        return $this->email;
    }
       public function getPassword(){
        return $this->password;
    }
       public function getRole(){
        return $this->role;
    }
}


class Teacher extends User{

public function getRole(): string {
        return 'teacher';
    }
}

class Student extends User{
    public function getRole(): string {
        return 'student';
    }

}
