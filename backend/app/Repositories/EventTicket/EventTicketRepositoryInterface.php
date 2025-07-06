<?php


namespace App\Repositories\EventTicket;

use App\Models\EventTicket;

interface EventTicketRepositoryInterface
{
    public function all();
    public function find(EventTicket $eventTicket);
    public function create(array $data);
    public function update(EventTicket $eventTicket, array $data);
    public function delete(EventTicket $eventTicket);
}