<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;

class dashMessage extends Controller
{
    //
    public function showMessagePage()
    {
        $messages = Message::all();

        return view("messages",compact("messages"));
    }

    public function addMessage(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/img', $file_name);

        //データベースに製品名と画像パスを保存
//        ※全てstorage内に保存されるのでpubicで使えるようにシンボリックリンクコマンド実行必要
        $messages = new Message();
        $messages->name = $request->name;
        $messages->role = $request->role!=null?$request->role:null;
        $messages->msg = $request->msg;
        $messages->title = $request->title;
        $messages->path = 'storage/img/'.$file_name;
        $messages->save();

        // 元のページに戻る
        return redirect()->route('show-message');
    }

    public function updateMessage(Request $request, Message $message)
    {

        $file_name =null;

        // アップロードされたファイル名を取得
        if($request->image!=null){
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/img', $file_name);
            $file_name = 'storage/img/'.$file_name;
            $str = $message->path;
            $str = str_replace('storage/img/', '', $str);
            Storage::disk('public')->delete('img/' . $str);
        }else{
            $file_name = $message->path;
        }


        $message->update([
            "role" => $request->role,
            "name" => $request->name,
            "title"=>$request->title,
            "msg"=>$request->msg,
            "path" => $file_name,
        ]);

        return redirect()->route('show-message');
    }

    public function deleteMessage(Request $request)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $plan = Message::find($request->id);
        // レコードを削除
        $plan->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('show-message');
    }
}
