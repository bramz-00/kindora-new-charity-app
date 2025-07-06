<?php
namespace App\Repositories\EventOrder;

use App\Models\EventOrder;
class EventOrderRepository implements EventOrderRepositoryInterface
{
    public function all()
    {
        return EventOrder::all();
    }

    public function find($eventOrder)
    {
        return EventOrder::findOrFail($eventOrder);
    }

    public function create(array $data)
    {
        return EventOrder::create($data);
    }

    public function update($eventOrder, array $data)
    {
        $eventOrder->update($data);
        return $eventOrder;
    }

    public function delete($eventOrder)
    {
        return $eventOrder->delete();
    }
}
