<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\JackpotContribution\StoreJackpotContributionRequest;
use App\Http\Requests\JackpotContribution\UpdateJackpotContributionRequest;
use App\Http\Resources\JackpotContributionResource;
use App\Models\JackpotContribution;
use App\Services\JackpotContribution\JackpotContributionService;

class JackpotContributionController extends Controller
{
    public function __construct(protected JackpotContributionService $jackpotContributionService)
    {
    }

    public function index()
    {
  
        return JackpotContributionResource::collection($this->jackpotContributionService->all());

    }

    public function store(StoreJackpotContributionRequest $request)
    {
        $data = $request->validated();
        $jackpotContribution = $this->jackpotContributionService->create($data);
        return new JackpotContributionResource($jackpotContribution);
    }

    public function show($jackpotContribution)
    {
        return new JackpotContributionResource($this->jackpotContributionService->find($jackpotContribution));
    }

    public function update(UpdateJackpotContributionRequest $request, JackpotContribution $jackpotContribution)
    {
        $data = $request->validated();
        $this->jackpotContributionService->update($jackpotContribution, $data);
        return new JackpotContributionResource($jackpotContribution);
    }

    public function destroy($jackpotContribution)
    {
        $this->jackpotContributionService->delete($jackpotContribution);
        return response()->json([
            'success' => true,
            'message' => 'JackpotContribution deleted successfully'
        ]);
    }
}
