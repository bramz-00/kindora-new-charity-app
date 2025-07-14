<?php


namespace App\Repositories\GoodProposal;

use App\Models\GoodProposal;

interface GoodProposalRepositoryInterface
{
    public function all();
    public function find(GoodProposal $goodProposal);
    public function create(array $data);
    public function update(GoodProposal $goodProposal, array $data);
    public function delete(GoodProposal $goodProposal);
}