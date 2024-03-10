<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseAPIController extends Controller
{
    //base controller constructor
    public function __construct()
    {
        $this->iddleware('auth:sanctum');
    }

    /**
     * Send the api response with the provided data
     */
    public function sendResponse($status, $code, $message, $payload){

        try{

            return response()->json([
                'status' => $status,
                'code' => $code,
                'message' => $message,
                'payload' => $payload
            ]);

        }catch(\Exception $exception){

            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Internal server error',
                'payload' => $exception->getMessage()
            ]);
        }
    }
}
