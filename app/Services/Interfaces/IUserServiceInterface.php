<?php
namespace App\Services\Interfaces;

interface IUserServiceInterface
{
    /**
     * @return array User
     */
    function getUsers();

    /**
     * @param int $id
     * @return User
     */
    function getUserById(int $id);

    /**
     * @param array $user
     * @return void
     */
    function postUser(array $user);

    /**
     * @param array $user
     * @param int $id
     * @return void
     */
    function putUser(array $user, int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function deleteUser(int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function restoreUser(int $id);

}
