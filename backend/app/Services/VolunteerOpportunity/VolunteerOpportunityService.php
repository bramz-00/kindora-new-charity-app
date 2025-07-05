<?php

namespace App\Services\VolunteerOpportunity;

use App\Repositories\VolunteerOpportunity\VolunteerOpportunityRepositoryInterface;


class VolunteerOpportunityService
{

    public function __construct(protected VolunteerOpportunityRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($volunteerOpportunity, array $data)
    {
        return $this->repository->update($volunteerOpportunity, $data);
    }
    

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}



