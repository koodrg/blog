<?php

namespace App\Console\Commands;

use App\Infrastructure\Models\Post;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class IndexElasticsearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:index-elasticsearch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Client $client)
    {

        $posts = Post::with('user')->get();
        $params = ['body' => []];
        $i = 0;

        foreach ($posts as $post) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'posts',
                    '_id' => $post->_id,
                ],
            ];

            $params['body'][] = [
                'title' => $post->title,
                'content' => $post->content,
                'user' => $post->user,
            ];
            $i++;

            if ($i % 1000 == 0) {
                $responses = $client->bulk($params);
                $params = ['body' => []];
                unset($responses);
            }
        }

        if (!empty($params['body'])) {
            $responses = $client->bulk($params);
        }
    }
}
