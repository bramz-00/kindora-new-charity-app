<?php


namespace App\Repositories\Review;

use App\Models\Review;

interface ReviewRepositoryInterface
{
    public function all();
    public function find(Review $review);
    public function create(array $data);
    public function update(Review $review, array $data);
    public function delete(Review $review);
}