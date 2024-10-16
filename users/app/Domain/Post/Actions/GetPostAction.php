<?php

namespace App\Domain\Post\Actions;

use App\Infrastructure\Repositories\PostRepository;

class GetPostAction
{
    public function __construct(public PostRepository $postRepository)
    {

    }

    public function handle($id)
    {
        return $this->postRepository->get($id);
    }
}
