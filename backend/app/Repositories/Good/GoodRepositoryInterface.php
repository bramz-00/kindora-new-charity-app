<?php


namespace App\Repositories\Good;

use App\Models\Good;

interface GoodRepositoryInterface
{
    public function all();
    public function find(Good $good);
    public function create(array $data);
    public function update(Good $good, array $data);
    public function delete(Good $good);
}