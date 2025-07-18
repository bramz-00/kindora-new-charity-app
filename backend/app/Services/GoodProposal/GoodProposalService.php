<?php

namespace App\Services\GoodProposal;

use App\Repositories\GoodProposal\GoodProposalRepositoryInterface;


class GoodProposalService
{

    public function __construct(protected GoodProposalRepositoryInterface $repository) {}

    public function all()
    {
        return $this->repository->all();
    }

    public function find($good_proposal)
    {
        return $this->repository->find($good_proposal);
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



    public function validate($proposal)
    {
        $proposal->validated_at = now();
        $proposal->status = 'completed';
        $proposal->save();
        return $proposal;
    }
    public function reject($proposal)
    {
        $proposal->validated_at = null;
        $proposal->status = 'rejected';
        $proposal->save();
        return $proposal;
    }
}
