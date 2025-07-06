<?php


namespace App\Repositories\VolunteerApplication;

use App\Models\VolunteerApplication;

interface VolunteerApplicationRepositoryInterface
{
    public function all();
    public function find(VolunteerApplication $volunteerApplication);
    public function create(array $data);
    public function update(VolunteerApplication $volunteerApplication, array $data);
    public function delete(VolunteerApplication $volunteerApplication);
}