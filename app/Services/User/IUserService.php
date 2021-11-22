<?php

namespace App\Services\User;

interface IUserService{
    public function create($email,$password,$user_name);
    public function getUser($email);
}
