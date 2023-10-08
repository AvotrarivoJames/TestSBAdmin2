<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;

class RegisterController extends Controller
{
    public function __construct(public UserService $userService){}

    public function index()
    {
        return view('auth.register');
    }
      
    public function signUp(StoreUserRequest $request)
    { 
        $user = $this->userService->create($request->validated());
        Auth::login($user);
        
        return redirect("/dashboard")->withSuccess('You have signed-in');
        /* return $user->isSuperAdmin 
            ? redirect("dashboard")->withSuccess('You have signed-in')
            : redirect("dashboard")->withSuccess('You have signed-in');*/
    }
}
