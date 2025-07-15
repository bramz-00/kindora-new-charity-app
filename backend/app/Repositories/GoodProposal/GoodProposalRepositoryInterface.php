<?php


namespace App\Repositories\GoodProposal;

use App\Models\GoodProposal;

interface GoodProposalRepositoryInterface
{
    public function all();
    public function find(GoodProposal $good_proposal);
    public function create(array $data);
    public function update(GoodProposal $good_proposal, array $data);
    public function delete(GoodProposal $good_proposal);
}