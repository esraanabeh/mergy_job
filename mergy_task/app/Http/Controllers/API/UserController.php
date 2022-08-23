<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Http\Requests\UpdateUser;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\ApiResponseTrait;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }
    
    public function index()
    {
       
        $users= $this->user->getAllUsers();
        return $this->apiResponse('successfully', new JobResource($users));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $user= $this->user->updateUser( $id ,  $request);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $user->addMediaFromRequest('cv')->toMediaCollection('cv');
        }
        return $this->apiResponse('successfully', new JobResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $users= $this->user->deleteUser($id);
        return $this->apiResponse( 'successfully' );
    }
}
