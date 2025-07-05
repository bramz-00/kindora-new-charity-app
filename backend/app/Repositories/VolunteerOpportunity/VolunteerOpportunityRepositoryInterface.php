<?php


namespace App\Repositories\VolunteerOpportunity;

use App\Models\VolunteerOpportunity;

interface VolunteerOpportunityRepositoryInterface
{
    public function all();
    public function find(VolunteerOpportunity $volunteerOpportunity);
    public function create(array $data);
    public function update(VolunteerOpportunity $volunteerOpportunity, array $data);
    public function delete(VolunteerOpportunity $volunteerOpportunity);
}