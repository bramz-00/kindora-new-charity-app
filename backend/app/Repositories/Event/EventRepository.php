<?php
namespace App\Repositories\Event;

use App\Models\Event;
class EventRepository implements EventRepositoryInterface
{
    public function all()
    {
        return Event::all();
    }

    public function find($id)
    {
        return Event::findOrFail($id);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update($id, array $data)
    {
        $event = $this->find($id);
        $event->update($data);
        return $event;
    }

    public function delete($id)
    {
        $event = $this->find($id);
        return $event->delete();
    }
}
