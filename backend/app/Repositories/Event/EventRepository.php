<?php
namespace App\Repositories\Event;

use App\Models\Event;
class EventRepository implements EventRepositoryInterface
{
    public function all()
    {
        return Event::all();
    }

    public function find($event)
    {
        return Event::findOrFail($event);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update($event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function delete($event)
    {
        return $event->delete();
    }
}
