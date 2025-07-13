<?php
namespace App\Repositories\Review;

use App\Models\Review;
class ReviewRepository implements ReviewRepositoryInterface
{
    public function all()
    {
        return Review::all();
    }

    public function find($review)
    {
        return Review::findOrFail($review);
    }

    public function update($review, array $data)
    {
        $review->update($data);
        return $review;
    }

    public function delete($review)
    {
        return $review->delete();
    }
}
