<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Post\Repositories\PostRepositoryInterface;
use App\Infrastructure\Models\Post;
use App\Infrastructure\Repositories\Common\BaseRepository;
use Elasticsearch\Client;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(public Client $client, Post $post)
    {
        $this->model = $post;
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

    public function create($data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        return Post::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Post::where('id', $id)->delete();
    }
}
