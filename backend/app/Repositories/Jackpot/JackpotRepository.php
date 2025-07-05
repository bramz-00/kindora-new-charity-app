<?php
namespace App\Repositories\Jackpot;

use App\Models\Jackpot;
class JackpotRepository implements JackpotRepositoryInterface
{
    public function all()
    {
        return Jackpot::all();
    }

    public function find($id)
    {
        return Jackpot::findOrFail($id);
    }

    public function create(array $data)
    {
        return Jackpot::create($data);
    }

    public function update($id, array $data)
    {
        $jackpot = $this->find($id);
        $jackpot->update($data);
        return $jackpot;
    }

    public function delete($id)
    {
        $jackpot = $this->find($id);
        return $jackpot->delete();
    }
}
