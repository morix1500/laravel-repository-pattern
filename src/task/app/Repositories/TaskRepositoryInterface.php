<?php
namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function create(int $user_id, string $contents);
    public function list(int $user_id);
    public function get(int $id, int $user_id);
    public function update(int $id, int $user_id, array $param);
}
