<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\Event\EventService;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService)
    {
    }

    public function index()
    {
  
        return EventResource::collection($this->eventService->all());

    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $event = $this->eventService->create($data);
        return new EventResource($event);
    }

    public function show($event)
    {
        return new EventResource($this->eventService->find($event));
    }

    public function update(UpdateEventRequest $request,Event $event)
    {
        $data = $request->validated();
        $this->eventService->update($event, $data);
        return new EventResource($event);
    }

    public function destroy($event)
    {
        $this->eventService->delete($event);
        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }
}
