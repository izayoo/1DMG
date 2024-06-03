<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class AuthController extends BaseController
{
    use ResponseTrait;

    private User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function login()
    {
        $rules = [
            'username' => 'required|max_length[255]',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $user = $this->model->where('username', $this->request->getVar('username'))->first();

        if(is_null($user)){
            return $this->failUnauthorized('Credentials not matched.');
        }

        $checkPassword = password_verify($this->request->getVar('password'), $user['password']);

        if (!$checkPassword){
            return $this->failUnauthorized('Credentials not matched.');
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        return $this->respond([
            'message' => 'Successfully logged in.',
            'token' => $token,
            'refresh_token' => ''
        ], 200);
    }
}
