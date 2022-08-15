<?php

namespace App\Http\Controllers\API;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use App\Models\Job;
use App\Models\Experience;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobWithResource;
use App\Http\Resources\ExperienceResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var Experience
     */
    protected $experienceModel;

    /**
     * @param Experience $experience
     */
    public function __construct(Experience $experience)
    {
        $this->experienceModel = $experience;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * */


    public function index()
    {
        //
       
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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //
        $validator = validator::make($request->all(), [
            // 'job_title' => 'required',
            // 'location' => 'required',
            // 'start_date' => 'required',
            // 'end_data' => 'required',    
           
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }
        $experience = $this->experienceModel->create([
            'job_id' => $request->post('job_id'),
            'job_title' => $request->post('job_title'),
            'location' => $request->post('location'),
            'start_date' => $request->post('start_date'), 
            'end_date' => $request->post('end_date'),  
        ]);

        return $this->apiResponse('successfully', $experience);

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
    public function update(Request $request, $id)
    {
        //
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
    }

    public function getJobWithExperience(){
        $data = Job::whereUserId(Auth::id())->with('experiences')->first();

        return $this->apiResponse('successfully',new JobWithResource( $data));

    }
}
