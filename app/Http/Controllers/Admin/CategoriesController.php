<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function allCategories ()
    {
        return view('admin.allCategories', [
            'categories' => Categories::all()
        ]);
    }

    public function addCategory (Request $request, Categories $category)
    {
        if ($request->method() == 'POST')
        {
            $freshCategory = $request->except('_token');
            if ((!$this->checkRequiredFields($freshCategory)))
            {
                $request->flash();
                return redirect()->route('admin.addCategory')->with('error', 'Забыли заполнить поля');
            }

            if ($request->file('category_image'))
            {
                $path = $request->file('category_image')->store('public/imgs/news_categories');
                $freshCategory['category_image'] = Storage::url($path);
            }
            $category->fill($freshCategory);
            $category->save();
            return redirect()->route('admin.addCategory')->with('success', 'Категория успешно добавленна');
        }
        return view('admin.addCategory');
    }

    public function delete(Categories $category)
    {
        $news = Categories::query()->find($category->id)->oneCategoryNews()->get();
        foreach ($news as $item) {
            Storage::delete('public/'.substr($item->news_image, 9));
        }
        Categories::query()->find($category->id)->oneCategoryNews()->delete();
        Storage::delete('public/'.substr($category->category_image, 9));
        $category->delete();
        return redirect()->route('admin.allCategories')->with('success', 'Категория успешно удалена!');
    }

    public function update(Categories $category)
    {
        return view('admin.addCategory', [
            'category' => $category,
        ]);
    }

    public function save(Request $request, Categories $category)
    {
        if ($request->method() == 'POST')
        {
            $freshCategory = $request->except('_token');
            if ($request->file('category_image'))
            {
                $path = $request->file('category_image')->store('public/imgs/news_categories');
                $freshCategory['category_image'] = Storage::url($path);
            }
            $category->fill($freshCategory);
            $category->save();
            if ((!$this->checkRequiredFields($freshCategory)))
            {
                return redirect()->route('admin.updateCategory', $category)->with('error', 'Забыли заполнить поля!!! Редактируем снова');
            }
            return redirect()->route('admin.allCategories')->with('success', 'Категория успешно сохраненна');
        }
    }

    public function checkRequiredFields($freshCategory)
    {
        foreach ($freshCategory as $item)
        {
            if (is_null($item))
            {
                return false;
            }
        }
        return true;
    }
}
