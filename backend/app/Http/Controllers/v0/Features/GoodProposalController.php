<?php

namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\GoodProposal\StoreGoodProposalRequest;
use App\Http\Requests\GoodProposal\UpdateGoodProposalRequest;
use App\Http\Resources\GoodProposalResource;
use App\Models\GoodProposal;
use App\Services\GoodProposal\GoodProposalService;

class GoodProposalController extends Controller
{
    public function __construct(protected GoodProposalService $goodService)
    {
    }

    public function index()
    {
  
        return GoodProposalResource::collection($this->goodService->all());

    }

    public function store(StoreGoodProposalRequest $request)
    {
        $data = $request->validated();
        return new GoodProposalResource($this->goodService->create($data));
    }

    public function show(GoodProposal $good)
    {
        return new GoodProposalResource($this->goodService->find($good));
    }

    public function update(UpdateGoodProposalRequest $request, GoodProposal $good)
    {
        $data = $request->validated();
        $this->goodService->update($good, $data);
        return new GoodProposalResource($good);
    }

    public function destroy(GoodProposal $good)
    {
        $this->goodService->delete($good);
        return response()->json([
            'success' => true,
            'message' => 'GoodProposal deleted successfully'
        ]);
    }



      public function validateGoodProposal(GoodProposal $good)
    {
        $this->goodService->delete($good);
        return response()->json([
            'success' => true,
            'message' => 'GoodProposal deleted successfully'
        ]);
    }
        public function rejectGoodProposal(GoodProposal $good)
    {
        $this->goodService->delete($good);
        return response()->json([
            'success' => true,
            'message' => 'GoodProposal deleted successfully'
        ]);
    }
}
