<?php

namespace App\Domain\Comment\Actions;

use App\Domain\Comment\Repositories\CommentRepositoryInterface;

class GetCommentAction
{
    public function __construct(public CommentRepositoryInterface $repository)
    {

    }

    public function handle($postId)
    {
        return $this->repository->getAll($postId);
    }
}
