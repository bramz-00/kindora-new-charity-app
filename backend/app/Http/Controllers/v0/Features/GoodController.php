<?php


namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;

use App\Http\Requests\Good\StoreGoodRequest;
use App\Http\Requests\Good\UpdateGoodRequest;
use App\Http\Resources\GoodResource;
use App\Models\Good;
use App\Services\Good\GoodService;

class GoodController extends Controller
{
    public function __construct(protected GoodService $goodService)
    {
    }

    public function index()
    {
  
        return GoodResource::collection($this->goodService->all());

    }

    public function store(StoreGoodRequest $request)
    {
        $data = $request->validated();
        return new GoodResource($this->goodService->create($data););
    }

    public function show($good)
    {
        return new GoodResource($this->goodService->find($good));
    }

    public function update(UpdateGoodRequest $request, Good $good)
    {
        $data = $request->validated();
        $this->goodService->update($good, $data);
        return new GoodResource($good);
    }

    public function destroy($good)
    {
        $this->goodService->delete($good);
        return response()->json([
            'success' => true,
            'message' => 'Good deleted successfully'
        ]);
    }
}
