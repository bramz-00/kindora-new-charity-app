<?php
namespace App\Repositories\Good;

use App\Models\Good;
class GoodRepository implements GoodRepositoryInterface
{
    public function all()
    {
        return Good::all();
    }

    public function find($good)
    {
        return Good::findOrFail($good);
    }

    public function create(array $data)
    {
        return Good::create($data);
    }

    public function update($good, array $data)
    {
        $good->update($data);
        return $good;
    }

    public function delete($good)
    {
        return $good->delete();
    }
}
