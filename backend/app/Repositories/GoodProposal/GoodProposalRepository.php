<?php
namespace App\Repositories\GoodProposal;

use App\Models\GoodProposal;
class GoodProposalRepository implements GoodProposalRepositoryInterface
{
    public function all()
    {
        return GoodProposal::all();
    }

    public function find($goodProposal)
    {
        return GoodProposal::findOrFail($goodProposal);
    }

    public function create(array $data)
    {
        return GoodProposal::create($data);
    }

    public function update($goodProposal, array $data)
    {
        $goodProposal->update($data);
        return $goodProposal;
    }

    public function delete($goodProposal)
    {
        return $goodProposal->delete();
    }
}
