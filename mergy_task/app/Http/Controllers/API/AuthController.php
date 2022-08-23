<?php

namespace App\Http\Controllers\API;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileUploaderTrait;
use App\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use App\Http\Resources\JobResource;
use App\Http\Requests\StoreUser;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    use ApiResponseTrait;
    /**
     * @var User
     */
    protected $userModel;
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }
   
    
     /**
     * @param Request $request
     * @return JsonResponse
     */

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return $this->apiResponseValidation($validator);
        }

        $user = User::whereEmail($request->post('email'))->first();

        if ($user) {
            if (!Hash::check($request->post('password'), $user->password)) {
                $message = 'Wrong password';
                return $this->apiResponse($message, null,403, 'not authorized');
            }


            $token = $user->createToken('token')->plainTextToken;

            return $this->apiResponse('successfully', new JobResource($user), 200 , null, $token);
        }

        return $this->apiResponse('not found user', '',403,  'not found user');
    }


    public function register( StoreUser $request ) {


        $user= $this->user->createUser($request);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $user->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $user->addMediaFromRequest('cv')->toMediaCollection('cv');
        }

      
     
        return $this->apiResponse( 'successfully',new JobResource($user) );
    }
}
