<?php

namespace App\Services\GoodProposal;

use App\Repositories\GoodProposal\GoodProposalRepositoryInterface;


class GoodProposalService
{

    public function __construct(protected GoodProposalRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($goodProposal)
    {
        return $this->repository->find($goodProposal);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($goodProposal, array $data)
    {
        return $this->repository->update($goodProposal, $data);
    }

    public function delete($goodProposal)
    {
        return $this->repository->delete($goodProposal);
    }
}



