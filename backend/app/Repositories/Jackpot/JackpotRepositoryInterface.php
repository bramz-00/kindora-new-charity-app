<?php


namespace App\Repositories\Jackpot;

use App\Models\Jackpot;

interface JackpotRepositoryInterface
{
    public function all();
    public function find(Jackpot $jackpot);
    public function create(array $data);
    public function update(Jackpot $jackpot, array $data);
    public function delete(Jackpot $jackpot);
}