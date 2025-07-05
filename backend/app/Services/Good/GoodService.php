<?php

namespace App\Services\Good;

use App\Repositories\Good\GoodRepositoryInterface;


class GoodService
{

    public function __construct(protected GoodRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($good)
    {
        return $this->repository->find($good);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($good, array $data)
    {
        return $this->repository->update($good, $data);
    }

    public function delete($good)
    {
        return $this->repository->delete($good);
    }
}



