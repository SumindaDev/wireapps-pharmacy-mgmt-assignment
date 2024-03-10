<?php

namespace App\Http\Controllers\API;

use App\Interfaces\API\AuthAPIInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthAPIController extends BaseAPIController
{
    private AuthAPIInterface $authAPIInterface;

    //used services
    public function __construct(AuthAPIInterface $authAPIInterface)
    {
        $this->authAPIInterface = $authAPIInterface;
    }


    //authenticate with the system and obtain the token for the user
    public function login(Request $request){

        try{
            //returns the login response with token and user data
            $response = $this->authAPIInterface->login($request);

            return $this->sendResponse(true,Response::HTTP_OK,'User logged in successfully !', $response['payload']);

        }catch(\Exception $exception){

            Log::channel('user_error_log')->info("[User Login] ==> user login error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'User login error ', $exception->getMessage());
        }
    }
}
