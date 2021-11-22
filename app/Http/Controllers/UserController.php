<?php

namespace App\Http\Controllers;

use App\Services\Invite\IInviteService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $inviteService;
    public function __construct(IInviteService $inviteService){
        $this->inviteService = $inviteService;
    }

    public function checkInvitation($token){
        return "Ivitation Accepted"." ".$token;
    }

    public function acceptInvitation($token){
        $invitation = $this->inviteService->getInvitation($token);
    }
}
