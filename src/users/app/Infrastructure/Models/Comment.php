<?php

namespace App\Infrastructure\Models;

use MongoDB\Laravel\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comments';
    protected $fillable = ['post_id', 'content', 'user_id', 'content', 'left', 'right', 'depth'];

    protected $casts = [
        'left' => 'integer',
        'right' => 'integer',
        'depth' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function descendants()
    {
        return $this->where('left', '>', $this->left)
            ->where('right', '<', $this->right)
            ->orderBy('left', 'asc')
            ->get();
    }

    public function parent()
    {
        return $this->where('left', '<', $this->left)
            ->where('right', '>', $this->right)
            ->orderBy('left', 'asc')
            ->first();
    }

    public function addChild($childData)
    {
        $this->makeSpaceForChild($childData['post_id']);

        $child = new Comment();
        $child->fill($childData);
        $child->left = $this->right;
        $child->right = $this->right + 1;
        $child->depth = $this->depth + 1;
        $child->save();

        // Update the parent right value after inserting the child
        $this->right += 2;
        $this->save();

        return $child;
    }

    // Make space in the nested set tree for a new child
    protected function makeSpaceForChild($postId)
    {
        Comment::where('post_id', $postId)->where('right', '>=', $this->right)->increment('right', 2);
        Comment::where('post_id', $postId)->where('left', '>', $this->right)->increment('left', 2);
    }
}
