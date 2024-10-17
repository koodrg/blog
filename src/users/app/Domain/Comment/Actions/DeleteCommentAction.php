<?php

namespace App\Domain\Comment\Actions;

use App\Domain\Comment\Repositories\CommentRepositoryInterface;

class DeleteCommentAction
{
    public function __construct(public CommentRepositoryInterface $repository)
    {
    }

    public function handle($commentId)
    {
        return $this->repository->update($commentId, ['content' => 'Comment deleted']);
    }
}
