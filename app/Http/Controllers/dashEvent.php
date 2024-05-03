<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class dashEvent extends Controller
{
    //
    public function showEvent()
    {
        $categories = Category::all();
        return view("edit-event",compact("categories"));
    }


    //Add Event
    public function addEvent(Request $request)
    {
        $post = Event::create([
            "date" => $request->date,
            "title" => $request->title,
            "category_id" => $request->category_id,
        ]);

        // 元のページに戻る
        return redirect()->route('show-event');
    }

    //Add Category
    public function addCategory(Request $request)
    {
        $post = Category::create([
            "category_name" => $request->category_name,
        ]);


        return redirect()->route('show-event');
    }

    //Edit
//    ※下記Category $categoryは不要だがもし引数2つformのactionで渡したい場合はこうする（edit-eventのformとweb.php参照）
    public function updateEvent(Request $request, Event $event)
    {
        $event->update([
           "date"=>$request->date,
           "title"=>$request->title,
            "category_id"=>$request->category_name
        ]);


        return redirect()->route('show-event');
    }

    public function deleteEvent(Request $request)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $plan = Event::find($request->id);
        // レコードを削除
        $plan->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('show-event');
    }
}

