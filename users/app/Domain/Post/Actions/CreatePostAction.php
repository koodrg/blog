<?php

namespace App\Domain\Post\Actions;

use App\Infrastructure\Repositories\PostRepository;

class CreatePostAction
{
    public function __construct(public PostRepository $postRepository)
    {
    }

    public function handle($data)
    {
        return $this->postRepository->create($data);
    }
}
