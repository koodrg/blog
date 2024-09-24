<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $userIds = User::all()->map(function($user) {
            return (string) $user->_id;
        })->toArray();

        for ($i = 0; $i < 50; $i++) {
            $images = [];
            $imageCount = rand(3, 5);
            for ($j = 0; $j < $imageCount; $j++) {
                $images[] = $faker->imageUrl(640, 480, 'nature', true, 'Post Image');
            }

            $idxUser = rand(0, count($userIds) - 1);

            Post::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'images' => $images,
                'created_by' => $userIds[$idxUser],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
