<?php

namespace App\Repositories\Repos;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository{

    

    public function getAllUsers()
    {
        return User::all();
    }


    public function getUserById($id)
    {
        return User::find($id);
    }


    public function createUser(  $request){
           return User::create( [
            'name' => $request->post( 'name' ),
            'email' => $request->post( 'email' ),
            'uid'=>$request->post('uid'),
            'password' => Hash::make( $request->post( 'password' ) ),
            'job' => $request->post('job'),  
            
        ] );

    }

    public function updateUser( $id ,  $request){
        User::find($id)->update([
            'uid' => $request->uid,
            'name' => $request->name,
            'email' => $request->email,
            'job' => $request->job,
        ]);
    }


    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }
}



?>