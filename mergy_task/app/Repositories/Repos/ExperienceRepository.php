<?php

namespace App\Repositories\Repos;
use App\Models\User;
use App\Models\Experience;
use Carbon\Carbon;
use App\Repositories\Interfaces\IExperienceRepository;
use Illuminate\Support\Facades\Auth;


class ExperienceRepository implements IExperienceRepository{

    public function getAllExperiences()
    {
        return Experience::all();
    }


    public function getExperienceById($id)
    {
        return Experience::find($id);
    }


    
    public function createExperience(  $request){
        return Experience::create( [
            'user_id' => Auth::id(),
            'job_title' => $request->post('job_title'),
            'location' => $request->post('location'),
            'start_date' => Carbon::parse($request->post('start_date')), 
            'end_date' => Carbon::parse($request->post('end_date')), 
         
     ] );

 }



 public function updateExperience( $id ,  $request){
     Experience::whereUserId(Auth::id())->find($id)->update([
            // 'user_id' => Auth::id(),
            'job_title' => $request->post( 'job_title' ),
            'location' => $request->post( 'location' ),
            'start_date' => Carbon::parse($request->post('start_date')), 
            'end_date' => Carbon::parse($request->post('end_date')),  
    ]);
}


public function deleteExperience($id)
{
    return Experience::find($id)->delete();
}



}

?>