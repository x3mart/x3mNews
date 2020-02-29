<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData(){
        $faker = Faker\Factory::create('ru_RU');
        $data = [];
        for ($ii = 1; $ii < 6; $ii++)
            for ($i = 0; $i < 10; $i++) {
                $data [] = [
                    'news_title'=> $faker->realText(rand(20, 40)),
                    'news_short' => $faker->realText(rand(100, 150)),
                    'news_inform' => $faker->realText(rand(2000, 3000)),
                    'news_private'=> false,
                    'news_image' => $faker->imageUrl(400, 200),
                    'news_category' => $ii,
                    'news_important' => rand(0,1),
                    'news_likes' => $faker->numberBetween(0, 364),
                    'news_views' => $faker->numberBetween(70, 3654)
                ];
        }
        return $data;
    }
}
