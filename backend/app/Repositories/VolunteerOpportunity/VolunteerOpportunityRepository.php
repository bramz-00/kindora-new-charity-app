<?php
namespace App\Repositories\VolunteerOpportunity;

use App\Models\VolunteerOpportunity;
class VolunteerOpportunityRepository implements VolunteerOpportunityRepositoryInterface
{
    public function all()
    {
        return VolunteerOpportunity::all();
    }

    public function find($id)
    {
        return VolunteerOpportunity::findOrFail($id);
    }

    public function create(array $data)
    {
        return VolunteerOpportunity::create($data);
    }

    public function update($id, array $data)
    {
        $volunteerOpportunity = $this->find($id);
        $volunteerOpportunity->update($data);
        return $volunteerOpportunity;
    }

    public function delete($id)
    {
        $volunteerOpportunity = $this->find($id);
        return $volunteerOpportunity->delete();
    }
}
