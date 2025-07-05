<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\EventRessource;
use App\Services\Event\EventService;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService)
    {
    }

    public function index()
    {
  
        return EventRessource::collection($this->eventService->all());

    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $event = $this->eventService->create($data);
        return new EventRessource($event);
    }

    public function show($id)
    {
        return response()->json($this->eventService->find($id));
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $data = $request->validated();
        $event = $this->eventService->update($id, $data);
        return new EventRessource($event);
    }

    public function destroy($id)
    {
        $this->eventService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }
}
