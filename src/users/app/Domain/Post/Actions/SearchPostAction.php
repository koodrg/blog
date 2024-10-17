<?php

namespace App\Domain\Post\Actions;

use App\Domain\Post\Repositories\PostRepositoryInterface;
use Elasticsearch\Client;
use Illuminate\Http\Request;

class SearchPostAction
{
    public function __construct(public PostRepositoryInterface $postRepositoryInterface)
    {
    }

    public function handle(Request $request)
    {
        return $this->postRepositoryInterface->search($request->q);
    }
}
