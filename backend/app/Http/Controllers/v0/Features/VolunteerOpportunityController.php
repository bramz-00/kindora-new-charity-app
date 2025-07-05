<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\VolunteerOpportunity\StoreVolunteerOpportunityRequest;
use App\Http\Requests\VolunteerOpportunity\UpdateVolunteerOpportunityRequest;
use App\Http\Resources\VolunteerOpportunityRessource;
use App\Services\VolunteerOpportunity\VolunteerOpportunityService;

class VolunteerOpportunityController extends Controller
{
    public function __construct(protected VolunteerOpportunityService $volunteerOpportunityService)
    {
    }

    public function index()
    {
  
        return VolunteerOpportunityRessource::collection($this->volunteerOpportunityService->all());

    }

    public function store(StoreVolunteerOpportunityRequest $request)
    {
        $data = $request->validated();
        $volunteerOpportunity = $this->volunteerOpportunityService->create($data);
        return new VolunteerOpportunityRessource($volunteerOpportunity);
    }

    public function show($id)
    {
        return response()->json($this->volunteerOpportunityService->find($id));
    }

    public function update(UpdateVolunteerOpportunityRequest $request, $id)
    {
        $data = $request->validated();
        $volunteerOpportunity = $this->volunteerOpportunityService->update($id, $data);
        return new VolunteerOpportunityRessource($volunteerOpportunity);
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
