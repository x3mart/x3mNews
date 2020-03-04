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
            $this->validate($request, Categories::rules(), [], Categories::fieldsAttributes());
            $freshCategory = $request->except('_token');
            if ($request->file('category_image'))
            {
                $path = $request->file('category_image')->store('public/imgs/news_categories');
                $freshCategory['category_image'] = Storage::url($path);
            }
            $result = $category->fill($freshCategory)->save();
            if($result)
            {
                return redirect()->route('admin.addCategory')->with('success', 'Категория успешно добавленна');
            } else
            {
                $request->flash();
                return redirect()->route('admin.addCategory')->with('error', 'Что то пошло не так!!!');
            }

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
            $this->validate($request, Categories::rules(), [], Categories::fieldsAttributes());
            $freshCategory = $request->except('_token');
            if ($request->file('category_image'))
            {
                $path = $request->file('category_image')->store('public/imgs/news_categories');
                $freshCategory['category_image'] = Storage::url($path);
            }
            if(!isset($freshCategory['category_private']))
            {
                $freshCategory['category_private'] = 0;
            }
            $result = $category->fill($freshCategory)->save();
            if ($result)
            {
                return redirect()->route('admin.allCategories')->with('success', 'Категория успешно сохраненна');
            } else{
                $request->flash();
                return redirect()->route('admin.updateCategory', $category)->with('error', 'Что то пошло не так!!!');
            }
        }
    }
}
