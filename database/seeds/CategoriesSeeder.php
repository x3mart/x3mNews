<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData() {
        $categories = json_decode(Storage::get('news/categories.json'), TRUE);
        $data = [];
        foreach ($categories as $item) {
            $data[] = [
                'category_name' => $item['cat_name'],
                'category_alias' => $item['cat_alias'],
                'category_description' => $item['cat_description'],
                'category_image' => '/storage/imgs/news_categories/'.$item['cat_alias'].'.jpg',
                'category_private' => 0
            ];
        }
        return $data;
    }
}
