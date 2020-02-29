<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('news_id')->unsigned();
            $table->string('news_title') -> comment('Заголовок новости');
            $table->text('news_short')->comment('Краткое описание новости');
            $table->text('news_inform')->comment('Полный текст новости');
            $table->boolean('news_private')
                ->default(false)
                ->comment('Только для зарегистрированных пользователей');
            $table->integer('news_category');
            $table->string('news_image')->default(null);
            $table->boolean('news_important')
                ->default(false)
                ->comment('Главная новость');
            $table->integer('news_likes')
                ->default(0)
                ->comment('Количество лайков у статьи');
            $table->integer('news_views')
                ->default(0)
                ->comment('Количество просмотров статьи');
            $table->integer('news_comments_count')
                ->default(0)
                ->comment('Количество коментариев');
            $table->timestamp('news_created_at')->useCurrent();
            $table->timestamp('news_updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
