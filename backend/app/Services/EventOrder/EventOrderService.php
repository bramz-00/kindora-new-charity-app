<?php

namespace App\Services\EventOrder;

use App\Repositories\EventOrder\EventOrderRepositoryInterface;


class EventOrderService
{

    public function __construct(protected EventOrderRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($eventOrder)
    {
        return $this->repository->find($eventOrder);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($eventOrder, array $data)
    {
        return $this->repository->update($eventOrder, $data);
    }

    public function delete($eventOrder)
    {
        return $this->repository->delete($eventOrder);
    }
}



