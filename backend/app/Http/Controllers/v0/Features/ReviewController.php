<?php

namespace App\Http\Controllers\v0\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Services\Review\ReviewService;

class ReviewController extends Controller
{
public function __construct(protected ReviewService $reviewService)
    {
    }

    public function index()
    {
  
        return ReviewResource::collection($this->reviewService->all());

    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $review = $this->reviewService->create($data);
        return new ReviewResource($review);
    }

    public function show($review)
    {
        return new ReviewResource($this->reviewService->find($review));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->validated();
        $this->reviewService->update($review, $data);
        return new ReviewResource($review);
    }

    public function destroy(Review $review)
    {
        $this->reviewService->delete($review);
        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully'
        ]);
    }

}
