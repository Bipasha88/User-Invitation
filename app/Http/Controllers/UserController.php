<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationCodeMail;
use App\Services\Invite\IInviteService;
use App\Services\User\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $inviteService;
    private $userService;

    public function __construct(IInviteService $inviteService, IUserService $userService){
        $this->inviteService = $inviteService;
        $this->userService = $userService;
    }

    public function checkInvitation($token){
        return "Ivitation Accepted"." ".$token;
    }

    public function acceptInvitation($token, Request $request){
        $invitation = $this->inviteService->getInvitation($token);
        $user = $this->userService->create($invitation->email,$request->password,$request->user_name);
        $code = rand(102345,601475);
        $user->registered = $code;
        $user->save();
        Mail::to($invitation->email)->send(new ConfirmationCodeMail($code));

        return response()->json("Confirmation code has been send",400);
    }

    public function confirmRegistration($token, Request $request){
        $invitation = $this->inviteService->getInvitation($token);
        $user = $this->userService->getUser($invitation->email);

        if($user->registered == $request->confirm_code){
            $user->registered = 1;
            $user->save();
            $invitation->delete();
            return response()->json("Registration Complete Successfully");
        }
        return response()->json("Invalid Confirmation Code");
    }
}
