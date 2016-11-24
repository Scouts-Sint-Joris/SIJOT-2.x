<?php

use App\News;
use App\Tags;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder
 *
 * @category Database_Table_Seeds.
 * @package  SIJOT_Website
 * @author   Tim Joosten <Topairy@gmail.com>
 * @license  MIT License
 * @link     https://github.com/Scouts-Sint-Joris/SIJOT-2.x
 */
class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $tags = factory(Tags::class, 3)->create();
        $news = factory(News::class, 3)
           ->create(['user_id' => $user->id,])
           ->each(function ($news) use ($tags) {
                $news->tags()->attach($tags);
            });
    }
}
