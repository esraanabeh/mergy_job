<?php

namespace App\Repositories\Interfaces;

interface IUserRepository{
    public function getAllUsers();

    public function getUserById($id);

    public function createUser(   $data);
    
    public function updateUser( $id ,  $data);

    public function deleteUser($id);

}









?>