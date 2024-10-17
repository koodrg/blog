<?php

namespace App\Domain\User\Repositories;

use App\Infrastructure\Models\User;

interface UserRepositoryInterface {
    public function getAll();
    public function find($id);
    public function create(array $data): User;
    public function delete($id): bool;
}
