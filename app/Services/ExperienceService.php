<?php


namespace App\Services;


use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceService
{

    protected $experiences;

    public function __construct($experiences)
    {
        $this->experiences = $experiences;
    }

    public function handle($user)
    {
        foreach($this->experiences as $experience) {
            $experienceToInsert = $this->setExperience($experience);
            if (!isset($experience['id'])) {
                $user->experiences()->create($experienceToInsert);
            } else {
                $user->experiences()->where('id' , $experience['id'])->update($experienceToInsert);
            }
        }
    }

    public function setExperience($experience) {

        return [
            'start_date' => $experience['start_date'],
            'end_date' => $experience['end_date'],
            'role' => $experience['role'],
            'company' => $experience['company'],
            'description' => $experience['description'],
            'current_job' => $experience['current_job'] ? $experience['current_job'] : false
        ];
    }

}