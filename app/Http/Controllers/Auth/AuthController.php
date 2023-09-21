<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected AuthService $authService;


  public function __construct(AuthService $authService){
    $this->authService = $authService;
    }

    public function login(Request $request) {
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->authService->login($data);
        return ResponseHelper::response(new AuthResource($user), Response::HTTP_OK);
    }

    /**
     * register
     *
     * @param  mixed $request
     * @return ResponseHelper
     */
    public function register(Request $request) {
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = $this->authService->register($data);
        return ResponseHelper::response(new AuthResource($user), Response::HTTP_OK);
    }
}
