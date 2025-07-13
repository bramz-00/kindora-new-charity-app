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

    public function find($volunteerOpportunity)
    {
        return $this->repository->find($volunteerOpportunity);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($volunteerOpportunity, array $data)
    {
        return $this->repository->update($volunteerOpportunity, $data);
    }
    

    public function delete($volunteerOpportunity)
    {
        return $this->repository->delete($volunteerOpportunity);
    }
}



