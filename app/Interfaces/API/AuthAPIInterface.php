<?php

namespace App\Interfaces\API;

use App\Http\Requests\API\LoginRequest;
use Illuminate\Http\Request;

interface AuthAPIInterface {

    //uses to login and obtain the token
    public function login(Request $request);
}

