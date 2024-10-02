<?php

namespace App\Domain\Post\Repositories;

use App\Domain\Post\Models\Post;
use Elasticsearch\Client;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(public Client $client)
    {

    }

    public function search(?string $q = '')
    {
        $page = request()->get('page', 1);
        $perPage = request()->get('perPage', 10);
        $from = ($page - 1) * $perPage;

        $params = [
            'index' => 'posts',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            ['match' => ['title' => $q]],
                            ['match' => ['content' => $q]],
                            ['match' => ['user.name' => $q]],
                        ],
                    ],
                ],
                'from' => $from,
                'size' => $perPage,
            ],
        ];

        $response = $this->client->search($params);
        $hits = $response['hits']['hits'];

        return $hits;
    }

    public function get($id): Post
    {
        return Post::find($id);
    }

    public function save(Post $product): void
    {

    }

    public function delete(Post $product): void
    {

    }
}
