<?php


namespace App\Repositories\EventOrder;

use App\Models\EventOrder;

interface EventOrderRepositoryInterface
{
    public function all();
    public function find(EventOrder $eventOrder);
    public function create(array $data);
    public function update(EventOrder $eventOrder, array $data);
    public function delete(EventOrder $eventOrder);
}