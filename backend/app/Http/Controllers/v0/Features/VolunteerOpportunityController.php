<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\VolunteerOpportunity\StoreVolunteerOpportunityRequest;
use App\Http\Requests\VolunteerOpportunity\UpdateVolunteerOpportunityRequest;
use App\Http\Resources\VolunteerOpportunityResource;
use App\Models\VolunteerOpportunity;
use App\Services\VolunteerOpportunity\VolunteerOpportunityService;

class VolunteerOpportunityController extends Controller
{
    public function __construct(protected VolunteerOpportunityService $volunteerOpportunityService)
    {
    }

    public function index()
    {
  
        return VolunteerOpportunityResource::collection($this->volunteerOpportunityService->all());

    }

    public function store(StoreVolunteerOpportunityRequest $request)
    {
        $data = $request->validated();
        $volunteerOpportunity = $this->volunteerOpportunityService->create($data);
        return new VolunteerOpportunityResource($volunteerOpportunity);
    }

    public function show($id)
    {
        return response()->json($this->volunteerOpportunityService->find($id));
    }

    public function update(UpdateVolunteerOpportunityRequest $request, VolunteerOpportunity $volunteerOpportunity)
    {
        $data = $request->validated();
        $updated = $this->volunteerOpportunityService->update($volunteerOpportunity, $data);
        return new VolunteerOpportunityResource($updated);
    }

    public function destroy($id)
    {
        $this->volunteerOpportunityService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'VolunteerOpportunity deleted successfully'
        ]);
    }
}
