<?php

namespace App\Services\Jackpot;

use App\Repositories\Jackpot\JackpotRepositoryInterface;


class JackpotService
{

    public function __construct(protected JackpotRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($jackpot)
    {
        return $this->repository->find($jackpot);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($jackpot, array $data)
    {
        return $this->repository->update($jackpot, $data);
    }

    public function delete($jackpot)
    {
        return $this->repository->delete($jackpot);
    }
}



