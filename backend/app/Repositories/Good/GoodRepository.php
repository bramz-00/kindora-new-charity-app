<?php
namespace App\Repositories\Good;

use App\Models\Good;
class GoodRepository implements GoodRepositoryInterface
{
    public function all()
    {
        return Good::all();
    }

    public function find($id)
    {
        return Good::findOrFail($id);
    }

    public function create(array $data)
    {
        return Good::create($data);
    }

    public function update($id, array $data)
    {
        $good = $this->find($id);
        $good->update($data);
        return $good;
    }

    public function delete($id)
    {
        $good = $this->find($id);
        return $good->delete();
    }
}
