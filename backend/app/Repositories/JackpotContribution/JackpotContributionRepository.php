<?php
namespace App\Repositories\JackpotContribution;

use App\Models\JackpotContribution;
class JackpotContributionRepository implements JackpotContributionRepositoryInterface
{
    public function all()
    {
        return JackpotContribution::all();
    }

    public function find($jackpotContribution)
    {
        return JackpotContribution::findOrFail($jackpotContribution);
    }

    public function create(array $data)
    {
        return JackpotContribution::create($data);
    }

    public function update($jackpotContribution, array $data)
    {
        $jackpotContribution->update($data);
        return $jackpotContribution;
    }

    public function delete($jackpotContribution)
    {
        return $jackpotContribution->delete();
    }
}
