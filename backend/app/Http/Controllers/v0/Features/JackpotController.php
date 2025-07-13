<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Jackpot\StoreJackpotRequest;
use App\Http\Requests\Jackpot\UpdateJackpotRequest;
use App\Http\Resources\JackpotResource;
use App\Models\Jackpot;
use App\Services\Jackpot\JackpotService;

class JackpotController extends Controller
{
    public function __construct(protected JackpotService $jackpotService)
    {
    }

    public function index()
    {
  
        return JackpotResource::collection($this->jackpotService->all());

    }

    public function store(StoreJackpotRequest $request)
    {
        $data = $request->validated();
        $jackpot = $this->jackpotService->create($data);
        return new JackpotResource($jackpot);
    }

    public function show(Jackpot $jackpot)
    {
        return new JackpotResource($this->jackpotService->find($jackpot));
    }

    public function update(UpdateJackpotRequest $request, Jackpot $jackpot)
    {
        $data = $request->validated();
        $this->jackpotService->update($jackpot, $data);
        return new JackpotResource($jackpot);
    }

    public function destroy(Jackpot $jackpot)
    {
        $this->jackpotService->delete($jackpot);
        return response()->json([
            'success' => true,
            'message' => 'Jackpot deleted successfully'
        ]);
    }
}
