<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function addNews(Request $request, News $news)
    {
        if ($request->method() == 'POST')
        {
            // $this->validate($request, News::rules(), [], News::fieldsAttributes());
            $freshNews = $request->except('_token');
            if ($request->file('news_image'))
            {
                $path = $request->file('news_image')->store('public/imgs');
                $freshNews['news_image'] = Storage::url($path);
            }
            $result = $news->fill($freshNews)->save();
            if($result)
            {
                return redirect()->route('admin.addNews')->with('success', 'Новость успешно добавленна');
            } else
            {
                $request->flash();
                return redirect()->route('admin.addNews')->with('error', 'Ошибка изменения новости');
            }

        }
        return view('admin.addNews', ['categories' => Categories::all()]);
    }

    public function delete(News $news)
    {
        Storage::delete('public/'.substr($news->news_image, 9));
        $news->delete();
        return redirect()->route('admin.admin')->with('success', 'Новость успешно удалена!');
    }

    public function update(News $news)
    {
        return view('admin.addNews', [
            'news' => $news,
            'categories' => Categories::all()
        ]);
    }

    public function save(Request $request, News $news)
    {
        if ($request->method() == 'POST')
        {
            //$this->validate($request, News::rules(), [], News::fieldsAttributes());
            $freshNews = $request->except('_token');
            if ($request->file('news_image'))
            {
                $path = $request->file('news_image')->store('public/imgs');
                $freshNews['news_image'] = Storage::url($path);
            }
            if(!isset($freshNews['news_private']))
            {
                $freshNews['news_private'] = 0;
            }
            if(!isset($freshNews['news_important']))
            {
                $freshNews['news_important'] = 0;
            }
            $result = $news->fill($freshNews)->save();
            if (!$result)
            {
                $request->flash();
                return redirect()->route('admin.updateNews', $news)->with('error', 'Забыли заполнить поля!!! Редактируем снова');
            }

            return redirect()->route('admin.admin')->with('success', 'Новость успешно сохраненна');
        }
    }

    // public function checkRequiredFields($freshNews)
    // {
    //     foreach ($freshNews as $item)
    //     {
    //         if (is_null($item))
    //         {
    //             return false;
    //         }
    //     }
    //     return true;
    // }
}
