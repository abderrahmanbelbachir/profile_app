<?php


namespace App\Services;


class OrganizationService
{

    protected $organizations;

    public function __construct($organizations)
    {
        $this->organizations = $organizations;
    }

    public function handle($user)
    {
        foreach($this->organizations as $organization) {
            $organizationToInsert = $this->setOrganization($organization);
            if (!isset($organization['id'])) {
                $user->organizations()->create($organizationToInsert);
            } else {
                $user->organizations()->where('id' , $organization['id'])->update($organizationToInsert);
            }
        }
    }

    public function setOrganization($organization) {
        return [
            'start_date' => $organization['start_date'],
            'end_date' => $organization['end_date'],
            'associated_as' => $organization['associated_as'],
            'organization' => $organization['organization'],
            'description' => $organization['description'],
            'current_job' => $organization['current_job'] ? $organization['current_job'] : false
        ];
    }

}