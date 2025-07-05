<?php
namespace App\Repositories\VolunteerOpportunity;

use App\Models\VolunteerOpportunity;
class VolunteerOpportunityRepository implements VolunteerOpportunityRepositoryInterface
{
    public function all()
    {
        return VolunteerOpportunity::all();
    }

    public function find($volunteerOpportunity)
    {
        return $volunteerOpportunity;
    }

    public function create(array $data)
    {
        return VolunteerOpportunity::create($data);
    }

    public function update($volunteerOpportunity, array $data)
    {
        $volunteerOpportunity->update($data);
        return $volunteerOpportunity;
    }

    public function delete($volunteerOpportunity)
    {
        return $volunteerOpportunity->delete();
    }
}
