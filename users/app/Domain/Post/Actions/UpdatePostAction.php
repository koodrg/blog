<?php

namespace App\Domain\Post\Actions;

use App\Infrastructure\Repositories\PostRepository;

class UpdatePostAction
{
    public function __construct(public PostRepository $postRepository)
    {
    }

    public function handle($id, $data)
    {
        return $this->postRepository->update($id, $data);
    }
}
