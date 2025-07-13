<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all users with optional pagination and filters
     */
    public function getAll(array $filters = [], ?int $perPage = null): Collection|LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        // Apply filters
        if (!empty($filters['status'])) {
            $query->where('is_active', $filters['status'] === true);
        }

        if (!empty($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (!empty($filters['created_from'])) {
            $query->whereDate('created_at', '>=', $filters['created_from']);
        }

        if (!empty($filters['created_to'])) {
            $query->whereDate('created_at', '<=', $filters['created_to']);
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Find user by ID
     */
    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create a new user
     */
    public function create(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->model->create($data);
    }

    /**
     * Update user by ID
     */
    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);
        
        if (!$user) {
            return false;
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $user->update($data);
    }

    /**
     * Delete user by ID
     */
    public function delete(int $id): bool
    {
        $user = $this->findById($id);
        
        if (!$user) {
            return false;
        }

        return $user->delete();
    }

    /**
     * Delete multiple users
     */
    public function deleteMultiple(array $ids): int
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    /**
     * Activate user account
     */
    public function activate(int $id): bool
    {
        return $this->update($id, ['is_active' => true]);
    }

    /**
     * Deactivate user account
     */
    public function deactivate(int $id): bool
    {
        return $this->update($id, ['is_active' => false]);
    }

    /**
     * Get active users only
     */
    public function getActiveUsers(?int $perPage = null): Collection|LengthAwarePaginator
    {
        $query = $this->model->where('is_active', true)->orderBy('created_at', 'desc');
        
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Get inactive users only
     */
    public function getInactiveUsers(?int $perPage = null): Collection|LengthAwarePaginator
    {
        $query = $this->model->where('is_active', false)->orderBy('created_at', 'desc');
        
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Search users by name or email
     */
    public function search(string $query, ?int $perPage = null): Collection|LengthAwarePaginator
    {
        $searchQuery = $this->model->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('email', 'LIKE', "%{$query}%")
              ->orWhere('first_name', 'LIKE', "%{$query}%")
              ->orWhere('last_name', 'LIKE', "%{$query}%");
        })->orderBy('created_at', 'desc');

        return $perPage ? $searchQuery->paginate($perPage) : $searchQuery->get();
    }

    /**
     * Update user profile
     */
    public function updateProfile(int $id, array $data): bool
    {
        $user = $this->findById($id);
        
        if (!$user) {
            return false;
        }

        // Remove sensitive fields from profile update
        unset($data['password'], $data['email_verified_at'], $data['remember_token']);

        return $user->update($data);
    }

    /**
     * Update user password
     */
    public function updatePassword(int $id, string $password): bool
    {
        return $this->update($id, ['password' => $password]);
    }

    /**
     * Check if user exists
     */
    public function exists(int $id): bool
    {
        return $this->model->where('id', $id)->exists();
    }

    /**
     * Get users count
     */
    public function count(): int
    {
        return $this->model->count();
    }
}