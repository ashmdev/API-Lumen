<?php

namespace App\Http\Controllers;

use App\Http\Validations\UserValidator;
use App\Services\Implementations\UserServiceImpl;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var UserServiceImpl
     */
    private $userService;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var UserValidator
     */
    private $validator;

    public function __construct(UserServiceImpl $userService, Request $request, UserValidator $validator)
    {


        $this->validator = $validator;
        $this->userService = $userService;
        $this->request = $request;
    }

    function createUser()
    {
        $validator = $this->validator->validate();
        if($validator->fails())
            return response([
                'status' => 422,
                'message' => 'Error',
                'errors' => $validator->errors()
            ], 422);
        else
        {
            $this->userService->postUser($this->request->all());
            return response("", 201);
        }

    }

    function listUsers()
    {
        return response($this->userService->getUsers());
    }

    function listUser(int $id){
        return response($this->userService->getUserById($id));
    }

    function updateUser(int $id){
        $validator = $this->validator->validate();
        if($validator->fails())
            return response([
                'status' => 422,
                'message' => 'Error',
                'errors' => $validator->errors()
            ], 422);
        else
        {
            $this->userService->putUser($this->request->all(), $id);
            return response("", 202);
        }
    }

    function restoreUser(int $id){
        return $this->userService->restoreUser($id)?
            response("",202):
            response("",204);
    }



}

