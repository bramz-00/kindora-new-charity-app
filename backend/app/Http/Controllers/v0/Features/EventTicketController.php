<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\EventTicket\StoreEventTicketRequest;
use App\Http\Requests\EventTicket\UpdateEventTicketRequest;
use App\Http\Resources\EventTicketResource;
use App\Models\EventTicket;
use App\Services\EventTicket\EventTicketService;

class EventTicketController extends Controller
{
    public function __construct(protected EventTicketService $eventTicketService)
    {
    }

    public function index()
    {
  
        return EventTicketResource::collection($this->eventTicketService->all());

    }

    public function store(StoreEventTicketRequest $request)
    {
        $data = $request->validated();
        $eventTicket = $this->eventTicketService->create($data);
        return new EventTicketResource($eventTicket);
    }

    public function show($eventTicket)
    {
        return new EventTicketResource($this->eventTicketService->find($eventTicket));
    }

    public function update(UpdateEventTicketRequest $request,EventTicket $eventTicket)
    {
        $data = $request->validated();
        $this->eventTicketService->update($eventTicket, $data);
        return new EventTicketResource($eventTicket);
    }

    public function destroy($eventTicket)
    {
        $this->eventTicketService->delete($eventTicket);
        return response()->json([
            'success' => true,
            'message' => 'EventTicket deleted successfully'
        ]);
    }
}
