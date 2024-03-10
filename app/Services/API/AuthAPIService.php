<?php

namespace App\Services\API;

use App\Http\Requests\API\LoginRequest;
use App\Http\Resources\API\UserAPIResource;
use App\Interfaces\API\AuthAPIInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAPIService implements AuthAPIInterface {

    //uses to login and obtain the token
    public function login(Request $request){

        $response = array();

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            $user = Auth::user();

            $response['status'] = true;
            $response['code'] = 200;
            $response['message'] = 'User logged in successfully !';
            $response['payload'] = array(
                'token' => $user->createToken('Token')->plainTextToken,
                'user' => UserAPIResource::make(Auth::user())
            );

            
        }else{

            $response['status'] = false;
            $response['code'] = 200;
            $response['message'] = 'Unauthorized login attempt';
            $response['payload'] = null;

        }

        return $response;
    }
}

