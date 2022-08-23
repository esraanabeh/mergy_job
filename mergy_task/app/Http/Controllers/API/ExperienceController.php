<?php

namespace App\Http\Controllers\API;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use App\Models\Job;
use Carbon\Carbon;
use App\Models\Experience;
use App\Http\Requests\StoreExperience;
use App\Http\Requests\UpdateExperience;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobWithResource;
use App\Http\Resources\ExperienceResource;
use App\Repositories\Interfaces\IExperienceRepository;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExperienceController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var Experience
     */
    // protected $experienceModel;
    protected $experience;

    /**
     * @param Experience $experience
     */
    public function __construct(IExperienceRepository $experience)
    {
        $this->experience = $experience;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * */


    public function index()
    {
        $experiences= $this->experience->getAllExperiences();
        return $this->apiResponse('successfully', ExperienceResource::collection(Experience::all()));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreExperience $request): \Illuminate\Http\JsonResponse
    {
        
        $experience= $this->experience->createExperience($request);

        return $this->apiResponse('successfully', new ExperienceResource($experience));

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
    public function update(UpdateExperience $request ,$id)
    {

        $experience= $this->experience->updateExperience( $id ,  $request);
        return $this->apiResponse('successfully', new ExperienceResource($experience));
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
        $experiences= $this->experience->deleteExperience($id);

        return $this->apiResponse( 'successfully' );
    }


    

    public function getJobWithExperience(){
        $data = User::whereId(Auth::id())->with('experience')->first();

        return $this->apiResponse('successfully',new JobWithResource( $data));

    }
}
