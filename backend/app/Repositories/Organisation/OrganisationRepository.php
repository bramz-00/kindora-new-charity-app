<?php
namespace App\Repositories\Organisation;

use App\Models\Organisation;
class OrganisationRepository implements OrganisationRepositoryInterface
{
    public function all()
    {
        return Organisation::all();
    }

    public function find($id)
    {
        return Organisation::findOrFail($id);
    }

    public function create(array $data)
    {
        return Organisation::create($data);
    }

    public function update($id, array $data)
    {
        $organisation = $this->find($id);
        $organisation->update($data);
        return $organisation;
    }

    public function delete($id)
    {
        $organisation = $this->find($id);
        return $organisation->delete();
    }
}
