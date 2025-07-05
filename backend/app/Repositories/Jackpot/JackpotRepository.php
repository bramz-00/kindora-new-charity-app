<?php
namespace App\Repositories\Jackpot;

use App\Models\Jackpot;
class JackpotRepository implements JackpotRepositoryInterface
{
    public function all()
    {
        return Jackpot::all();
    }

    public function find($jackpot)
    {
        return Jackpot::findOrFail($jackpot);
    }

    public function create(array $data)
    {
        return Jackpot::create($data);
    }

    public function update($jackpot, array $data)
    {
        $jackpot->update($data);
        return $jackpot;
    }

    public function delete($jackpot)
    {
        return $jackpot->delete();
    }
}
