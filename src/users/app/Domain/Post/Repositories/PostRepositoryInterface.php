<?php

namespace App\Domain\Post\Repositories;

use App\Infrastructure\Models\Post;

interface PostRepositoryInterface {
    public function search(?string $q = "");
    public function getAll();
    public function find($id);
    public function create(Post $product);
    public function update($id, array $data);
    public function delete($id);
}
