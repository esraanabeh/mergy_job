<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\JobResource;
use App\Http\Resources\ExperienceResource;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller


{

    use ApiResponseTrait;

    /**
     * @var Job
     */
    protected $jobModel;

    /**
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->jobModel = $job;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $job = $this->jobModel->whereUserId(Auth::id())->first();

        return $this->apiResponse('successfully', new JobResource($job));

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
            'ids' => 'required',
            'name' => 'required',
            'email' => 'required',
            'job' => 'required',
            'image' => 'required',
            'cv' => 'required',
           
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $job = $this->jobModel->create([
            'ids'=>$request->post('ids'),
            'user_id' => Auth::id(),
            'name' => $request->post('name'),
            'email' => $request->post('email'), 
            'job' => $request->post('job'),  
        ]);
        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $job->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $job->addMediaFromRequest('cv')->toMediaCollection('cv');
        }

        return $this->apiResponse('successfully', $job);
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
        $validator = validator::make($request->all(), [
            'job_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $job= $this->jobModel->whereId($request->post('job_id'))->first();

        return $this->apiResponse('successfully', $job);
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
}
