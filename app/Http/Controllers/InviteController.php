<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Services\Invite\IInviteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    private $inviteService;
    public function __construct(IInviteService $inviteService){
        $this->inviteService = $inviteService;
    }
    public function invite(Request $request){
        $token = rand(200,6000).time();
        $this->inviteService->create($request->email,$token);
        Mail::to($request->email)->send(new InvitationMail($token));

        return response()->json("Invitation has been send.",400);
    }
}
