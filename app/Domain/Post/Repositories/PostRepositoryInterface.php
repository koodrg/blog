<?php

namespace App\Domain\Post\Repositories;

use App\Domain\Post\Models\Post;
use Elasticsearch\Client;

interface PostRepositoryInterface {
    public function search(?string $q = "");
    public function get($id): Post;
    public function save(Post $product): void;
    public function delete(Post $product): void;
}
