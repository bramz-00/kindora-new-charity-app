<?php


namespace App\Repositories\Organisation;

use App\Models\Organisation;

interface OrganisationRepositoryInterface
{
    public function all();
    public function find(Organisation $organisation);
    public function create(array $data);
    public function update(Organisation $organisation, array $data);
    public function delete(Organisation $organisation);
}