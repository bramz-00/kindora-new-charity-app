<?php


namespace App\Repositories\Event;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function all();
    public function find(Event $event);
    public function create(array $data);
    public function update(Event $event, array $data);
    public function delete(Event $event);
}