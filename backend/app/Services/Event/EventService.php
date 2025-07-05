<?php

namespace App\Services\Event;

use App\Repositories\Event\EventRepositoryInterface;


class EventService
{

    public function __construct(protected EventRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($event)
    {
        return $this->repository->find($event);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($event, array $data)
    {
        return $this->repository->update($event, $data);
    }

    public function delete($event)
    {
        return $this->repository->delete($event);
    }
}



