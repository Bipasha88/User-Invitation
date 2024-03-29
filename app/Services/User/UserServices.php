<?php

namespace App\Services\User;

use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\Auth;

class UserServices implements IUserService{

    private $userRepository;
    public function __construct(IUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function create($email,$password,$user_name){
        return $this->userRepository->create([
            'email' => $email,
            'password' => bcrypt($password),
            'user_name' => $user_name,
        ]);
    }

    public function getUser($email){
        return $this->userRepository->where("email",$email)->first();
    }

    public function update($data){
        $this->userRepository->updateById(Auth::id(),$data);
    }
}
