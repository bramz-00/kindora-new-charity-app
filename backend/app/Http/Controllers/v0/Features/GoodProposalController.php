<?php

namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\GoodProposal\StoreGoodProposalRequest;
use App\Http\Requests\GoodProposal\UpdateGoodProposalRequest;
use App\Http\Resources\GoodProposalResource;
use App\Models\GoodProposal;
use App\Services\GoodProposal\GoodProposalService;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GoodProposalController extends Controller
{
    public function __construct(protected GoodProposalService $goodProposalService) {}

    public function index()
    {

        return GoodProposalResource::collection($this->goodProposalService->all());
    }

    public function store(StoreGoodProposalRequest $request)
    {
        $data = $request->validated();
        return new GoodProposalResource($this->goodProposalService->create($data));
    }

    public function show(GoodProposal $good_proposal)
    {
        $url = route('good_proposals.validate', $good_proposal->req_uuid);
        $qrSvg = QrCode::format('svg')->size(300)->generate($url);
        return view('req', [
            'proposal' => $good_proposal,
            'qr_code_svg' => $qrSvg,
        ]);
    }

    public function update(UpdateGoodProposalRequest $request, GoodProposal $good)
    {
        $data = $request->validated();
        $this->goodProposalService->update($good, $data);
        return new GoodProposalResource($good);
    }

    public function destroy(GoodProposal $good)
    {
        $this->goodProposalService->delete($good);
        return response()->json([
            'success' => true,
            'message' => 'GoodProposal deleted successfully'
        ]);
    }



    public function validateGoodProposal($id)
    {
        $proposal = GoodProposal::where('req_uuid', $id)->first();

        if (!$proposal) {
            return response()->json(['message' => 'Code invalide.'], 404);
        }

        if ($proposal->validated_at) {
            return response()->json(['message' => 'Déjà validé.'], 400);
        }
        $this->goodProposalService->validate($proposal);
        return response()->json(['message' => 'GoodProposal validé avec succès.']);
    }




    public function rejectGoodProposal(GoodProposal $good)
    {
        $this->goodProposalService->delete($good);
        return response()->json([
            'success' => true,
            'message' => 'GoodProposal deleted successfully'
        ]);
    }
}
