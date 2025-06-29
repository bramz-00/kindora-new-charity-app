<?php

namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Organisation\StoreOrganisationRequest;
use App\Http\Requests\Organisation\UpdateOrganisationRequest;
use App\Http\Resources\OrganisationRessource;
use App\Models\Organisation;
use App\Services\Organisation\OrganisationService;

class OrganisationController extends Controller
{
    public function __construct(protected OrganisationService $organisationService)
    {
    }

    public function index()
    {
  
        return OrganisationRessource::collection($this->organisationService->all());

    }

    public function store(StoreOrganisationRequest $request)
    {
        $data = $request->validated();
        $organisation = $this->organisationService->create($data);
        return new OrganisationRessource($organisation);
    }

    public function show($id)
    {
        return response()->json($this->organisationService->find($id));
    }

    public function update(UpdateOrganisationRequest $request, $id)
    {
        $data = $request->validated();
        $organisation = $this->organisationService->update($id, $data);
        return new OrganisationRessource($organisation);
    }

    public function destroy($id)
    {
        $this->organisationService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Organisation deleted successfully'
        ]);
    }
}
