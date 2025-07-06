<?php


namespace App\Repositories\JackpotContribution;

use App\Models\JackpotContribution;

interface JackpotContributionRepositoryInterface
{
    public function all();
    public function find(JackpotContribution $jackpotContribution);
    public function create(array $data);
    public function update(JackpotContribution $jackpotContribution, array $data);
    public function delete(JackpotContribution $jackpotContribution);
}