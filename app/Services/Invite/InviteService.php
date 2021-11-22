<?php

namespace App\Services\Invite;

use App\Repositories\Invite\IInviteRepository;

class InviteService implements IInviteService{

    private $inviteRepository;
    public function __construct(IInviteRepository $inviteRepository){
        $this->inviteRepository = $inviteRepository;
    }

    public function create($email,$token){
        return $this->inviteRepository->create([
            'email' => $email,
            'token' => $token,
        ]);
    }

    public function getInvitation($token){
        return $this->inviteRepository->where("token",$token)->first();
    }
}
