<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Comment\Repositories\CommentRepositoryInterface;
use App\Infrastructure\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAll($postId)
    {
        return Comment::where('post_id', $postId)->with('user')->get();
    }

    public function get()
    {

    }

    public function find($id)
    {
        return Comment::find($id);
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update($commentId, $data)
    {
        return Comment::where('id', $commentId)->update($data);
    }

    public function getMaxRight($postId)
    {
        $maxValue = Comment::raw(function ($collection) use ($postId) {
            return $collection->aggregate([
                [
                    '$match' => [
                        "post_id" => $postId,
                    ],
                ],
                [
                    '$group' => [
                        '_id' => null,
                        'max_value' => ['$max' => '$right'],
                    ],
                ],
            ]);
        })->toArray();

        if (!empty($maxValue)) {
            return $maxValue[0]['max_value'];
        }

        return 0;
    }
}
