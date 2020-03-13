<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserAddSocialAuth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->string('id_in_soc', 20)
                ->default('')
                ->comment('id in social network');
            $table->enum('type_auth', ['site', 'vk', 'fb', 'g+', 'ya', 'mail.ru', 'ok'])
                ->comment('Через что авторизовались');
            $table->string('avatar', 150)
                ->default('')
                ->comment('Ссылка на аватар');
            $table->index('id_in_soc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn(['id_in_soc', 'type_auth', 'avatar']);
        });
    }
}
