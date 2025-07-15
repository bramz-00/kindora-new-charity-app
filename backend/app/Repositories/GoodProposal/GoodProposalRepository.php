<?php
namespace App\Repositories\GoodProposal;

use App\Models\GoodProposal;
class GoodProposalRepository implements GoodProposalRepositoryInterface
{
    public function all()
    {
        return GoodProposal::all();
    }

    public function find($good_proposal)
    {
        return GoodProposal::findOrFail($good_proposal->id);
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
