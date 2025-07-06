<?php

namespace App\Services\JackpotContribution;

use App\Repositories\JackpotContribution\JackpotContributionRepositoryInterface;


class JackpotContributionService
{

    public function __construct(protected JackpotContributionRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($jackpotContribution)
    {
        return $this->repository->find($jackpotContribution);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($jackpotContribution, array $data)
    {
        return $this->repository->update($jackpotContribution, $data);
    }

    public function delete($jackpotContribution)
    {
        return $this->repository->delete($jackpotContribution);
    }
}



