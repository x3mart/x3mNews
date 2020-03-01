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
            $freshNews = $request->except('_token');
            if ((!$this->checkRequiredFields($freshNews)))
            {
                $request->flash();
                return redirect()->route('admin.addNews')->with('error', 'Забыли заполнить поля');
            }
//            $news = new News;
            if ($request->file('news_image'))
            {
                $path = $request->file('news_image')->store('public/imgs');
                $freshNews['news_image'] = Storage::url($path);
            }
            $news->fill($freshNews);
            $news->save();
            return redirect()->route('admin.addNews')->with('success', 'Новость успешно добавленна');
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
            $freshNews = $request->except('_token');
            if ($request->file('news_image'))
            {
                $path = $request->file('news_image')->store('public/imgs');
                $freshNews['news_image'] = Storage::url($path);
            }
            $news->fill($freshNews);
            $news->save();
            $request->flash();
            if ((!$this->checkRequiredFields($freshNews)))
            {
                return redirect()->route('admin.updateNews', $news)->with('error', 'Забыли заполнить поля!!! Редактируем снова');
            }

            return redirect()->route('admin.admin')->with('success', 'Новость успешно сохраненна');
        }
    }

    public function checkRequiredFields($freshNews)
    {
        foreach ($freshNews as $item)
        {
            if (is_null($item))
            {
                return false;
            }
        }
        return true;
    }
}
