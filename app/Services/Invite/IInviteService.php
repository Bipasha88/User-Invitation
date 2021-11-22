<?php

namespace App\Services\Invite;

interface IInviteService{
    public function create($email,$token);
    public function getInvitation($token);
}
