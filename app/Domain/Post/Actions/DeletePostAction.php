<?php

namespace App\Domain\Post\Actions;

use App\Infrastructure\Repositories\PostRepository;

class DeletePostAction
{
    public function __construct(public PostRepository $postRepository)
    {

    }

    public function handle($id)
    {
        return $this->postRepository->delete($id);
    }
}
