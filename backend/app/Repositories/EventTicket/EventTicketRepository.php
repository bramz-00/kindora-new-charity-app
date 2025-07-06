<?php
namespace App\Repositories\EventTicket;

use App\Models\EventTicket;
class EventTicketRepository implements EventTicketRepositoryInterface
{
    public function all()
    {
        return EventTicket::all();
    }

    public function find($eventTicket)
    {
        return EventTicket::findOrFail($eventTicket);
    }

    public function create(array $data)
    {
        return EventTicket::create($data);
    }

    public function update($eventTicket, array $data)
    {
        $eventTicket->update($data);
        return $eventTicket;
    }

    public function delete($eventTicket)
    {
        return $eventTicket->delete();
    }
}
