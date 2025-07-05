<?php

namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Organisation\StoreOrganisationRequest;
use App\Http\Requests\Organisation\UpdateOrganisationRequest;
use App\Http\Resources\OrganisationResource;
use App\Models\Organisation;
use App\Services\Organisation\OrganisationService;

class OrganisationController extends Controller
{
    public function __construct(protected OrganisationService $organisationService)
    {
    }

    public function index()
    {
        return OrganisationResource::collection($this->organisationService->all());
    }

    public function store(StoreOrganisationRequest $request)
    {
        $data = $request->validated();
        $organisation = $this->organisationService->create($data);
        return new OrganisationResource($organisation);
    }

    public function show(Organisation $organisation)
    {
        return new OrganisationResource($this->organisationService->find($organisation));
    }

    public function update(UpdateOrganisationRequest $request, Organisation $organisation)
    {
        $data = $request->validated();
        $this->organisationService->update($organisation, $data);
        return new OrganisationResource($organisation);
    }

    public function destroy($organisation)
    {
        $this->organisationService->delete($organisation);
        return response()->json([
            'success' => true,
            'message' => 'Organisation deleted successfully'
        ]);
    }
}
