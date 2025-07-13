<?php

namespace App\Services\Review;

use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ReviewService
{

    public function __construct(protected ReviewRepositoryInterface $repository) {}

    public function all()
    {
        return $this->repository->all();
    }

    public function find($review)
    {
        return $this->repository->find($review);
    }

    public function create(array $data)
    {
        $modelClass = $this->resolveModelClass($data['reviewable_type']);
        $model = $modelClass::findOrFail($data['reviewable_id']);

        return $model->reviews()->create([
            'comment' => $data['comment'],
            'rating' => $data['rating'],
            'created_by_id' => Auth::user()->id,
        ]);
    }

    public function update($review, array $data)
    {
        return $this->repository->update($review, $data);
    }

    public function delete($review)
    {
        // dd($review);
        return $this->repository->delete($review);
    }




    protected function resolveModelClass(string $type)
    {
        $map = [
            'user' => \App\Models\User::class,
            'organisation' => \App\Models\Organisation::class,
            'event' => \App\Models\Event::class,
            'jackpot' => \App\Models\Jackpot::class,
            'goods' => \App\Models\Good::class,
            'volunteer_opportunity' => \App\Models\VolunteerOpportunity::class,
        ];

        $key = Str::lower($type);

        if (!array_key_exists($key, $map)) {
            throw new \InvalidArgumentException("Invalid reviewable type: $type");
        }

        return $map[$key];
    }
}
