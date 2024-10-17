<?php

namespace App\Domain\Comment\Actions;

use App\App\Api\Requests\CreateCommentRequest;
use App\Domain\Comment\Repositories\CommentRepositoryInterface;
use App\Infrastructure\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CreateCommentAction
{
    public function __construct(public CommentRepositoryInterface $repository)
    {
    }

    public function handle(CreateCommentRequest $request)
    {
        $postId = $request->post_id;

        if($request->comment_id) {
            /** @var Comment $parentComment */
            $parentComment = $this->repository->find($request->comment_id);

            return $parentComment->addChild([
                'post_id' => $request->input('post_id'),
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
            ]);
        }

        $maxRight = $this->repository->getMaxRight($postId);

        return $this->repository->create([
            'post_id' => $request->post_id,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'left' => $request->$maxRight + 1,
            'right' => $request->$maxRight + 2,
            'depth' => 0
        ]);
    }
}
