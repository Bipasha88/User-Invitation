<?php

namespace App\Services\User;

use App\Repositories\User\IUserRepository;

class UserServices implements IUserService{

    private $userRepository;
    public function __construct(IUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

}
