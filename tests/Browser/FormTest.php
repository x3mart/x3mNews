<?php

namespace Tests\Browser;

use App\Categories;
use App\News;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FormTest extends DuskTestCase
{
    /**
     * Тестируем создание новости, проверяем, что она создана, после проверяем, что отмеченно свойство important
     *
     * @return void
     */
    public function testAddNewsImportantChecked()
    {
        $this->browse(function (Browser $browser) {

            $max =News::query()->orderByDesc('id')->first();
            $id = $max->id + 1;
            $browser->visit('/admin/addNews')
                    ->type('news_title', '1233445')
                    ->select('news_category', 2)
                    ->type('news_short', 'sdfsdfsfgsdf dsfg dsfgsdf dg dfsgsdg gfsdgdgdfgdsdgsddfsg  gsdfgsdfgdsf gsdfgsdfg ')
                    ->type('news_inform','sdfsdfsfgsdf dsfg dsfgsdf dg dfsgsdg gfsdgdgdfgdsdgsddfsg  gsdfgsdfgdsf gsdfgsdfg
                    sdfsdfsfgsdf dsfg dsfgsdf dg dfsgsdg gfsdgdgdfgdsdgsddfsg  gsdfgsdfgdsf gsdfgsdfg
                    sdfsdfsfgsdf dsfg dsfgsdf dg dfsgsdg gfsdgdgdfgdsdgsddfsg  gsdfgsdfgdsf gsdfgsdfg
                    sdfsdfsfgsdf dsfg dsfgsdf dg dfsgsdg gfsdgdgdfgdsdgsddfsg  gsdfgsdfgdsf gsdfgsdfg')
                    ->attach('news_image', __DIR__.'/test_img/kwokka.jpg')
                    ->check('news_important')
                    ->press('Создать')
                    ->assertSee('Новость успешно')
                    ->visit("/admin/editNews/{$id}")
                    ->assertChecked('news_important');
        });
    }

    /**
     * Тестируем возможность снять свойство important при редактировании Новости
     *
     *
     * @return void
     * @group foo
     */
    public function testEditNewsImportantUnchecked()
    {
        $this->browse(function (Browser $browser) {

            $max =News::query()->orderByDesc('id')->first();
            $id = $max->id;
            $browser->visit("/admin/editNews/{$id}")
                    ->uncheck('news_important')
                    ->click('#save')
                    ->assertSee('Новость успешно')
                    ->visit("/admin/editNews/{$id}")
                    ->assertNotChecked('news_important');
        });
    }

    /**
     * Тестируем создание новой категории
     *
     * @return void
     */
    public function testAddCategory()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/admin/categories/addCategory')
                    ->type('category_name', 'HOBOSTI')
                    ->type('category_alias', 'hobosti')
                    ->type('category_description', 'sdfsdfsfgsdf dsfg dsfgsdf dg dfsgsdg gfsdgdgdfgdsdgsddfsg  gsdfgsdfgdsf gsdfgsdfg ')
                    ->check('category_private')
                    ->attach('category_image', __DIR__.'/test_img/kwokka.jpg' )
                    ->press('Создать')
                    ->assertSee('Категория успешно');
        });
    }

    /**
     * Тестируем невозможность создать Категорию с уже существующим именем и псевдонимом и удаляем сзданную в предыдущем тесте категорию
     *
     * @return void
     */
    public function testCategoryUnique()

    {
        $this->browse(function (Browser $browser) {
            $max =Categories::query()->orderByDesc('id')->first();
            $id = $max->id;
            $browser->visit('/admin/categories/addCategory')
                    ->type('category_name', 'HOBOSTI')
                    ->type('category_alias', 'hobosti')
                    ->press('Создать')
                    ->assertSee('Название категории уже существует')
                    ->assertSee('Псевдоним уже существует')
                    ->visit("/admin/categories/deleteCategory{$id}")
                    ->assertSee('успешно удалена!');
        });
    }
}
