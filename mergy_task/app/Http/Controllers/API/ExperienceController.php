<?php

namespace App\Http\Controllers\API;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use App\Models\Job;
use Carbon\Carbon;
use App\Models\Experience;
use App\Http\Resources\JobResource;
use App\Http\Resources\JobWithResource;
use App\Http\Resources\ExperienceResource;
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
            'job_title' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'location' => 'required|string',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',    
           
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }
        $experience = $this->experienceModel->create([
            'job_id' => $request->post('job_id'),
            'job_title' => $request->post('job_title'),
            'location' => $request->post('location'),
            'start_date' => Carbon::parse($request->post('start_date')), 
            'end_date' => Carbon::parse($request->post('end_date')),  
        ]);

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
    public function update(Request $request ,$id)
    {
        //
        $validator = validator::make( $request->all(), [
           
            'job_title' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'location' => 'required|string',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',    
            
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation( $validator );
        }

        $experience = $this->experienceModel->whereHas('job',function($query){
            $query->whereUserId(Auth::id());
        })->find($id);

        if(!$experience){
            $response = ['code'=>400,'message'=>'id not valid'];
            throw new HttpResponseException(response()->json($response, 400));
        }

        $experience->update([
          
            'job_title' => $request->post( 'job_title' ),
            'location' => $request->post( 'location' ),
            'start_date' => Carbon::parse($request->post('start_date')), 
            'end_date' => Carbon::parse($request->post('end_date')),  
            
        ]);
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
        $this->experienceModel->findorfail($id)->delete();

        return $this->apiResponse( 'successfully' );
    }


    

    public function getJobWithExperience(){
        $data = Job::whereUserId(Auth::id())->with('experiences')->first();

        return $this->apiResponse('successfully',new JobWithResource( $data));

    }
}
