<?php

namespace App\Services\EventTicket;

use App\Repositories\EventTicket\EventTicketRepositoryInterface;


class EventTicketService
{

    public function __construct(protected EventTicketRepositoryInterface $repository)
    {
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($eventTicket)
    {
        return $this->repository->find($eventTicket);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($eventTicket, array $data)
    {
        return $this->repository->update($eventTicket, $data);
    }

    public function delete($eventTicket)
    {
        return $this->repository->delete($eventTicket);
    }
}



