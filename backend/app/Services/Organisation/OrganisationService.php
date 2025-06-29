<?php

namespace App\Services\Organisation;

use App\Repositories\Organisation\OrganisationRepositoryInterface;


class OrganisationService
{
    public function __construct(protected OrganisationRepositoryInterface $repository)
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

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
   
}
