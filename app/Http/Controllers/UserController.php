<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UserCreateRequest;
use App\Mail\ConfirmationCodeMail;
use App\Services\Invite\IInviteService;
use App\Services\User\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $invitation = $this->inviteService->getInvitation($token);
        $user = $this->userService->getUser($invitation->email);
        if(!$user)
            return "Ivitation Accepted"." ".$token;
        else
            return "Already a registered member";
    }

    public function acceptInvitation($token, UserCreateRequest $request){
        $invitation = $this->inviteService->getInvitation($token);
        $user = $this->userService->getUser($invitation->email);
        if(!$user) {
            $user = $this->userService->create($invitation->email, $request->password, $request->user_name);
            $code = rand(102345, 601475);
            $user->registered = $code;
            $user->save();
            Mail::to($invitation->email)->send(new ConfirmationCodeMail($code));

            return response()->json("Confirmation code has been send", 400);
        }
        else
            return "Already a registered member";
    }

    public function confirmRegistration($token, Request $request){
        $invitation = $this->inviteService->getInvitation($token);
        $user = $this->userService->getUser($invitation->email);

        if($user->registered == $request->confirm_code){
            $user->registered = 1;
            $user->save();
            return response()->json("Registration Complete Successfully");
        }
        return response()->json("Invalid Confirmation Code");
    }

    public function updateProfile(UpdateProfileRequest $request){
        $dataToUpdate = [];

        if ($request->name != null) {
            $dataToUpdate["name"] = $request->name;
        }
        if ($request->avatar != null) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatar'), $avatarName);
            $dataToUpdate["avatar"] = $avatarName;
        }
        $this->userService->update($dataToUpdate);
        return response()->json("Profile Updated");
    }
}
