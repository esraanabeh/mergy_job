<?php

namespace App\Repositories\Interfaces;

interface IExperienceRepository{
    public function getAllExperiences();

    public function getExperienceById($id);

    public function createExperience(   $data);
    
    public function updateExperience( $id ,  $data);

    public function deleteExperience($id);

}









?>