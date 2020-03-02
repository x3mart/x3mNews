<?php

use App\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(News::class, 50)->create();
    }
}
