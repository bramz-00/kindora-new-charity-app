<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\EventOrder\StoreEventOrderRequest;
use App\Http\Requests\EventOrder\UpdateEventOrderRequest;
use App\Http\Resources\EventOrderResource;
use App\Models\EventOrder;
use App\Services\EventOrder\EventOrderService;

class EventOrderController extends Controller
{
    public function __construct(protected EventOrderService $eventOrderService)
    {
    }

    public function index()
    {
  
        return EventOrderResource::collection($this->eventOrderService->all());

    }

    public function store(StoreEventOrderRequest $request)
    {
        $data = $request->validated();
        $eventOrder = $this->eventOrderService->create($data);
        return new EventOrderResource($eventOrder);
    }

    public function show(EventOrder $eventOrder)
    {
        return new EventOrderResource($this->eventOrderService->find($eventOrder));
    }

    public function update(UpdateEventOrderRequest $request,EventOrder $eventOrder)
    {
        $data = $request->validated();
        $this->eventOrderService->update($eventOrder, $data);
        return new EventOrderResource($eventOrder);
    }

    public function destroy(EventOrder $eventOrder)
    {
        $this->eventOrderService->delete($eventOrder);
        return response()->json([
            'success' => true,
            'message' => 'Event order deleted successfully'
        ]);
    }
}
