<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Jackpot\StoreJackpotRequest;
use App\Http\Requests\Jackpot\UpdateJackpotRequest;
use App\Http\Resources\JackpotRessource;
use App\Services\Jackpot\JackpotService;

class JackpotController extends Controller
{
    public function __construct(protected JackpotService $jackpotService)
    {
    }

    public function index()
    {
  
        return JackpotRessource::collection($this->jackpotService->all());

    }

    public function store(StoreJackpotRequest $request)
    {
        $data = $request->validated();
        $jackpot = $this->jackpotService->create($data);
        return new JackpotRessource($jackpot);
    }

    public function show($id)
    {
        return response()->json($this->jackpotService->find($id));
    }

    public function update(UpdateJackpotRequest $request, $id)
    {
        $data = $request->validated();
        $jackpot = $this->jackpotService->update($id, $data);
        return new JackpotRessource($jackpot);
    }

    public function destroy($id)
    {
        $this->jackpotService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Jackpot deleted successfully'
        ]);
    }
}
