<?php

namespace App\Services\VolunteerApplication;

use App\Repositories\VolunteerApplication\VolunteerApplicationRepositoryInterface;


class VolunteerApplicationService
{

    public function __construct(protected VolunteerApplicationRepositoryInterface $repository)
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

    public function update($volunteerApplication, array $data)
    {
        return $this->repository->update($volunteerApplication, $data);
    }
    

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}



