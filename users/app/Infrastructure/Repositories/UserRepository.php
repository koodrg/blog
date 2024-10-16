<?php

namespace App\Infrastructure\Repositories;

use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Models\User;
use App\Infrastructure\Repositories\Common\BaseRepository;
use MongoDB\Laravel\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function delete($id): bool
    {
        return User::where('id', $id)->delete();
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
