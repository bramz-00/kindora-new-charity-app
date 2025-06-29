<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Good\StoreGoodRequest;
use App\Http\Requests\Good\UpdateGoodRequest;
use App\Http\Resources\GoodRessource;
use App\Services\Good\GoodService;

class GoodController extends Controller
{
    public function __construct(protected GoodService $goodService)
    {
    }

    public function index()
    {
  
        return GoodRessource::collection($this->goodService->all());

    }

    public function store(StoreGoodRequest $request)
    {
        $data = $request->validated();
        $good = $this->goodService->create($data);
        return new GoodRessource($good);
    }

    public function show($id)
    {
        return response()->json($this->goodService->find($id));
    }

    public function update(UpdateGoodRequest $request, $id)
    {
        $data = $request->validated();
        $good = $this->goodService->update($id, $data);
        return new GoodRessource($good);
    }

    public function destroy($id)
    {
        $this->goodService->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Good deleted successfully'
        ]);
    }
}
