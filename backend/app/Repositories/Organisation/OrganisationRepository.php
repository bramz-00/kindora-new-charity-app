<?php
namespace App\Repositories\Organisation;

use App\Models\User;
class OrganisationRepository
{
    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update(User $user, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
