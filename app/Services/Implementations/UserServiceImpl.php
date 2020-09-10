<?php
namespace App\Services\Implementations;

use App\Models\User;
use App\Services\Interfaces\IUserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements IUserServiceInterface
{
    private $model;

    function __construct()
    {
        $this->model  = new User();
    }

    function getUsers()
    {
        return $this->model->get();
    }

    function getUserById(int $id)
    {
        return $this->model->find($id);
    }

    function postUser(array $user)
    {
        $user['password'] = Hash::make($user['password']);
        $this->model->create($user);
    }

    function putUser(array $user, int $id)
    {
        if(isset($user['password'])) $user['password'] = Hash::make($user['password']);
        $this->model->where('id',$id)->first()->update($user);
    }

    function deleteUser(int $id)
    {
        $user = $this->model->find($id);
        if(isset($user))
        {
            $user->delete();
            return true;
        }
        return false;
     }

    function restoreUser(int $id)
    {
        $user = $this->model->withTrashed()->find($id);
        if(isset($user))
        {
            $user->restore();
            return true;
        }
        return false;
    }
}
