<?php
namespace App\Repositories\Organisation;

use App\Models\Organisation;
class OrganisationRepository implements OrganisationRepositoryInterface
{
    public function all()
    {
        return Organisation::all();
    }

    public function find($organisation)
    {
        return $organisation;
    }

    public function create(array $data)
    {
        return Organisation::create($data);
    }

    public function update($organisation, array $data)
    {
        $organisation->update($data);
        return $organisation;
    }

    public function delete($organisation)
    {
        return $organisation->delete();
    }
}
