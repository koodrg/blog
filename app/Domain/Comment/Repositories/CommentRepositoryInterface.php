<?php

namespace App\Domain\Comment\Repositories;

use App\Infrastructure\Models\Comment;

interface CommentRepositoryInterface {
    public function getAll($postId);
    public function find($commentId);
    public function create(array $data);
    public function update($commentId, $data);
    public function getMaxRight($postId);
}
