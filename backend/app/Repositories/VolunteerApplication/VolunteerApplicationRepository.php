<?php
namespace App\Repositories\VolunteerApplication;

use App\Models\VolunteerApplication;
class VolunteerApplicationRepository implements VolunteerApplicationRepositoryInterface
{
    public function all()
    {
        return VolunteerApplication::all();
    }

    public function find($volunteerApplication)
    {
        return $volunteerApplication;
    }

    public function create(array $data)
    {
        return VolunteerApplication::create($data);
    }

    public function update($volunteerApplication, array $data)
    {
        $volunteerApplication->update($data);
        return $volunteerApplication;
    }

    public function delete($volunteerApplication)
    {
        return $volunteerApplication->delete();
    }
}
