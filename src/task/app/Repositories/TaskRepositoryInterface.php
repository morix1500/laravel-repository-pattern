<?php
namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function create(int $user_id, string $contents);
    public function list(int $user_id);
}
