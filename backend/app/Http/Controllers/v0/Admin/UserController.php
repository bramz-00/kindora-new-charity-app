<?php

namespace App\Http\Controllers\v0\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    //     $this->middleware(['role_or_permission:super-admin|edit users'])->except(['index', 'show', 'updateProfile', 'changePassword', 'activate', 'deactivate', 'toggleStatus', 'search', 'getActiveUsers', 'getInactiveUsers', 'bulkActivate', 'bulkDeactivate', 'getStats']);
    //     $this->middleware(['role_or_permission:super-admins|view userss'])->only(['index', 'show']);
    // 
    }

    /**
     * Display a listing of users
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['status', 'role', 'created_from', 'created_to']);
            $perPage = $request->get('per_page', 15);
            
            $users = $this->userService->getAllUsers($filters, $perPage);
            
            return response()->json([
                'success' => true,
                'data' => UserResource::collection($users),
                'meta' => $users instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator 
                    ? [
                        'current_page' => $users->currentPage(),
                        'last_page' => $users->lastPage(),
                        'per_page' => $users->perPage(),
                        'total' => $users->total(),
                    ] : []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created user
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => new UserResource($user)
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified user
     */
    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified user
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $result = $this->userService->updateUser($id, $request->validated());
            
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            $user = $this->userService->getUserById($id);
            
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => new UserResource($user)
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $result = $this->userService->deleteUser($id);
            
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete multiple users
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:users,id'
        ]);

        try {
            $result = $this->userService->deleteMultipleUsers($request->ids);
            
            return response()->json($result, $result['success'] ? 200 : 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update user profile
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $result = $this->userService->updateProfile($user, $request->validated());

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => new UserResource($user)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change user password
     */
    public function changePassword(ChangePasswordRequest $request, int $id): JsonResponse
    {
        try {
            $result = $this->userService->changePassword(
                $id,
                $request->current_password,
                $request->new_password
            );
            
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change password',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activate user account
     */
    public function activate(int $id): JsonResponse
    {
        try {
            $result = $this->userService->activateUser($id);
            
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'User activated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Deactivate user account
     */
    public function deactivate(int $id): JsonResponse
    {
        try {
            $result = $this->userService->deactivateUser($id);
            
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'User deactivated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to deactivate user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle user status
     */
    public function toggleStatus(int $id): JsonResponse
    {
        try {
            $result = $this->userService->toggleUserStatus($id);
            
            return response()->json($result, $result['success'] ? 200 : 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle user status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search users
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:2',
            'per_page' => 'nullable|integer|min:1|max:100'
        ]);

        try {
            $users = $this->userService->searchUsers(
                $request->query,
                $request->get('per_page', 15)
            );
            
            return response()->json([
                'success' => true,
                'data' => UserResource::collection($users),
                'meta' => $users instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator 
                    ? [
                        'current_page' => $users->currentPage(),
                        'last_page' => $users->lastPage(),
                        'per_page' => $users->perPage(),
                        'total' => $users->total(),
                    ] : []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get active users
     */
    public function getActiveUsers(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $users = $this->userService->getActiveUsers($perPage);
            
            return response()->json([
                'success' => true,
                'data' => UserResource::collection($users),
                'meta' => $users instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator 
                    ? [
                        'current_page' => $users->currentPage(),
                        'last_page' => $users->lastPage(),
                        'per_page' => $users->perPage(),
                        'total' => $users->total(),
                    ] : []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve active users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get inactive users
     */
    public function getInactiveUsers(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $users = $this->userService->getInactiveUsers($perPage);
            
            return response()->json([
                'success' => true,
                'data' => UserResource::collection($users),
                'meta' => $users instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator 
                    ? [
                        'current_page' => $users->currentPage(),
                        'last_page' => $users->lastPage(),
                        'per_page' => $users->perPage(),
                        'total' => $users->total(),
                    ] : []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve inactive users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk activate users
     */
    public function bulkActivate(Request $request): JsonResponse
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:users,id'
        ]);

        try {
            $result = $this->userService->bulkActivateUsers($request->ids);
            
            return response()->json($result, $result['success'] ? 200 : 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk deactivate users
     */
    public function bulkDeactivate(Request $request): JsonResponse
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:users,id'
        ]);

        try {
            $result = $this->userService->bulkDeactivateUsers($request->ids);
            
            return response()->json($result, $result['success'] ? 200 : 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to deactivate users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user statistics
     */
    public function getStats(): JsonResponse
    {
        try {
            $stats = $this->userService->getUserStats();
            
            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
