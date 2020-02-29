<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('category_name')
                ->nullable(true)
                -> comment('Название категории');
            $table->string('category_alias')
                ->nullable(true)
                ->comment('Название категории на латинице');
            $table->text('category_description')
                ->nullable(true)
                ->comment('Описание раздела');
            $table->string('category_image')->nullable(true);
            $table->boolean('category_private')->default(false);
//            $table->timestamp('category_created_at')->useCurrent();
//            $table->timestamp('category_updated_at')->useCurrent();
        });
//       (new CategoriesSeeder())->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
