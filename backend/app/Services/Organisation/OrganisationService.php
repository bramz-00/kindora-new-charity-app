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

    public function find($organisation)
    {
        return $this->repository->find($organisation);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($organisation, array $data)
    {
        return $this->repository->update($organisation, $data);
    }

    public function delete($organisation)
    {
        return $this->repository->delete($organisation);
    }
   
}
