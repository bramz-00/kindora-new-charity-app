<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Get all users with optional pagination
     */
    public function getAll(array $filters = [], ?int $perPage = null): Collection|LengthAwarePaginator;

    /**
     * Find user by ID
     */
    public function findById(int $id): ?User;

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User;

    /**
     * Create a new user
     */
    public function create(array $data): User;

    /**
     * Update user by ID
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete user by ID
     */
    public function delete(int $id): bool;

    /**
     * Delete multiple users
     */
    public function deleteMultiple(array $ids): int;

    /**
     * Activate user account
     */
    public function activate(int $id): bool;

    /**
     * Deactivate user account
     */
    public function deactivate(int $id): bool;

    /**
     * Get active users only
     */
    public function getActiveUsers(?int $perPage = null): Collection|LengthAwarePaginator;

    /**
     * Get inactive users only
     */
    public function getInactiveUsers(?int $perPage = null): Collection|LengthAwarePaginator;

    /**
     * Search users by name or email
     */
    public function search(string $query, ?int $perPage = null): Collection|LengthAwarePaginator;

    /**
     * Update user profile
     */
    public function updateProfile(int $id, array $data): bool;

    /**
     * Update user password
     */
    public function updatePassword(int $id, string $password): bool;

    /**
     * Check if user exists
     */
    public function exists(int $id): bool;

    /**
     * Get users count
     */
    public function count(): int;
}