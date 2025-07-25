<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\VolunteerApplication\StoreVolunteerApplicationRequest;
use App\Http\Requests\VolunteerApplication\UpdateVolunteerApplicationRequest;
use App\Http\Resources\VolunteerApplicationResource;
use App\Models\VolunteerApplication;
use App\Services\VolunteerApplication\VolunteerApplicationService;

class VolunteerApplicationController extends Controller
{
    public function __construct(protected VolunteerApplicationService $volunteerApplicationService)
    {
    }

    public function index()
    {
  
        return VolunteerApplicationResource::collection($this->volunteerApplicationService->all());

    }

    public function store(StoreVolunteerApplicationRequest $request)
    {
        $data = $request->validated();
        $volunteerApplication = $this->volunteerApplicationService->create($data);
        return new VolunteerApplicationResource($volunteerApplication);
    }

    public function show(VolunteerApplication $volunteerApplication)
    {
        return new VolunteerApplicationResource($this->volunteerApplicationService->find($volunteerApplication));
    }

    public function update(UpdateVolunteerApplicationRequest $request, VolunteerApplication $volunteerApplication)
    {
        $data = $request->validated();
        $updated = $this->volunteerApplicationService->update($volunteerApplication, $data);
        return new VolunteerApplicationResource($updated);
    }

    public function destroy(VolunteerApplication $volunteerApplication)
    {
        $this->volunteerApplicationService->delete($volunteerApplication);
        return response()->json([
            'success' => true,
            'message' => 'VolunteerApplication deleted successfully'
        ]);
    }
}
