<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users with filters and pagination
     */
    public function getAllUsers(array $filters = [], int $perPage = 15): Collection|LengthAwarePaginator
    {
        return $this->userRepository->getAll($filters, $perPage);
    }

    /**
     * Get user by ID
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Get user by email
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * Create a new user
     */
    public function createUser(array $data): User
    {
        // Check if email already exists
        if ($this->userRepository->findByEmail($data['email'])) {
            throw ValidationException::withMessages([
                'email' => ['The email has already been taken.']
            ]);
        }

        DB::beginTransaction();
        try {
            // Handle avatar upload if present
            if (isset($data['avatar']) && $data['avatar']) {
                $data['avatar_path'] = $this->handleAvatarUpload($data['avatar']);
                unset($data['avatar']);
            }

            // Set default values
            $data['is_active'] = $data['is_active'] ?? true;
            $data['role'] = $data['role'] ?? 'user';

            $user = $this->userRepository->create($data);
            
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update user
     */
    public function updateUser(int $id, array $data): bool
    {
        // Check if user exists
        if (!$this->userRepository->exists($id)) {
            return false;
        }

        // Check email uniqueness if email is being updated
        if (isset($data['email'])) {
            $existingUser = $this->userRepository->findByEmail($data['email']);
            if ($existingUser && $existingUser->id !== $id) {
                throw ValidationException::withMessages([
                    'email' => ['The email has already been taken.']
                ]);
            }
        }

        DB::beginTransaction();
        try {
            // Handle avatar upload if present
            if (isset($data['avatar']) && $data['avatar']) {
                $data['avatar_path'] = $this->handleAvatarUpload($data['avatar'], $id);
                unset($data['avatar']);
            }

            $result = $this->userRepository->update($id, $data);
            
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->userRepository->findById($id);
        
        if (!$user) {
            return false;
        }

        DB::beginTransaction();
        try {
            // Delete user avatar if exists
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $result = $this->userRepository->delete($id);
            
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete multiple users
     */
    public function deleteMultipleUsers(array $ids): array
    {
        if (empty($ids)) {
            return ['success' => false, 'message' => 'No users selected for deletion'];
        }

        DB::beginTransaction();
        try {
            // Get users to delete their avatars
            $users = User::whereIn('id', $ids)->get();
            
            // Delete avatars
            foreach ($users as $user) {
                if ($user->avatar_path) {
                    Storage::disk('public')->delete($user->avatar_path);
                }
            }

            $deletedCount = $this->userRepository->deleteMultiple($ids);
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => "Successfully deleted {$deletedCount} user(s)",
                'deleted_count' => $deletedCount
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Failed to delete users: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Update user profile
     */
    public function updateProfile(User $user, array $data): bool
    {
        DB::beginTransaction();
        try {
            // Handle avatar upload if present
            if (isset($data['avatar']) && $data['avatar']) {
                $data['avatar_path'] = $this->handleAvatarUpload($data['avatar'], $user->id);
                unset($data['avatar']);
            }

            $result = $this->userRepository->updateProfile($user->id, $data);

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Change user password
     */
    public function changePassword(int $id, string $currentPassword, string $newPassword): bool
    {
        $user = $this->userRepository->findById($id);
        
        if (!$user) {
            return false;
        }

        // Verify current password
        if (!Hash::check($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.']
            ]);
        }

        return $this->userRepository->updatePassword($id, $newPassword);
    }

    /**
     * Reset user password (admin function)
     */
    public function resetPassword(int $id, string $newPassword): bool
    {
        return $this->userRepository->updatePassword($id, $newPassword);
    }

    /**
     * Activate user account
     */
    public function activateUser(int $id): bool
    {
        return $this->userRepository->activate($id);
    }

    /**
     * Deactivate user account
     */
    public function deactivateUser(int $id): bool
    {
        return $this->userRepository->deactivate($id);
    }

    /**
     * Toggle user status
     */
    public function toggleUserStatus(int $id): array
    {
        $user = $this->userRepository->findById($id);
        
        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }

        $newStatus = !$user->is_active;
        $result = $this->userRepository->update($id, ['is_active' => $newStatus]);
        
        if ($result) {
            $statusText = $newStatus ? 'activated' : 'deactivated';
            return [
                'success' => true,
                'message' => "User has been {$statusText}",
                'new_status' => $newStatus
            ];
        }

        return ['success' => false, 'message' => 'Failed to update user status'];
    }

    /**
     * Get active users
     */
    public function getActiveUsers(int $perPage = 15): Collection|LengthAwarePaginator
    {
        return $this->userRepository->getActiveUsers($perPage);
    }

    /**
     * Get inactive users
     */
    public function getInactiveUsers(int $perPage = 15): Collection|LengthAwarePaginator
    {
        return $this->userRepository->getInactiveUsers($perPage);
    }

    /**
     * Search users
     */
    public function searchUsers(string $query, int $perPage = 15): Collection|LengthAwarePaginator
    {
        return $this->userRepository->search($query, $perPage);
    }

    /**
     * Get user statistics
     */
    public function getUserStats(): array
    {
        $totalUsers = $this->userRepository->count();
        $activeUsers = $this->userRepository->getActiveUsers()->count();
        $inactiveUsers = $this->userRepository->getInactiveUsers()->count();

        return [
            'total_users' => $totalUsers,
            'active_users' => $activeUsers,
            'inactive_users' => $inactiveUsers,
            'activation_rate' => $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 2) : 0
        ];
    }

    /**
     * Handle avatar upload
     */
    private function handleAvatarUpload($avatar, ?int $userId = null): string
    {
        // Delete old avatar if updating
        if ($userId) {
            $user = $this->userRepository->findById($userId);
            if ($user && $user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
        }

        // Store new avatar
        $filename = time() . '_' . $avatar->getClientOriginalName();
        $path = $avatar->storeAs('avatars', $filename, 'public');
        
        return $path;
    }

    /**
     * Bulk activate users
     */
    public function bulkActivateUsers(array $ids): array
    {
        if (empty($ids)) {
            return ['success' => false, 'message' => 'No users selected'];
        }

        try {
            $updatedCount = User::whereIn('id', $ids)->update(['is_active' => true]);
            
            return [
                'success' => true,
                'message' => "Successfully activated {$updatedCount} user(s)",
                'updated_count' => $updatedCount
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to activate users: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Bulk deactivate users
     */
    public function bulkDeactivateUsers(array $ids): array
    {
        if (empty($ids)) {
            return ['success' => false, 'message' => 'No users selected'];
        }

        try {
            $updatedCount = User::whereIn('id', $ids)->update(['is_active' => false]);
            
            return [
                'success' => true,
                'message' => "Successfully deactivated {$updatedCount} user(s)",
                'updated_count' => $updatedCount
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to deactivate users: ' . $e->getMessage()
            ];
        }
    }
   
}



