<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;

class dashInterview extends Controller
{
    //
    public function showInterviewPage()
    {
        $interviews = Interview::all();

        return view("interviews",compact("interviews"));
    }

    public function addInterview(Request $request)
    {
        // アップロードされたファイル名を取得
        $file_name1 = $request->file('path_1')->getClientOriginalName();
        $file_name2 = $request->file('path_2')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('path_1')->storeAs('public/img', $file_name1);
        $request->file('path_2')->storeAs('public/img', $file_name2);

        $interviews = new Interview();
        $interviews->name = $request->name;
        $interviews->hire_year = $request->hire_year;
        $interviews->school = $request->school;
        $interviews->department = $request->department!=null?$request->department:null;
        $interviews->faculty = $request->faculty!=null?$request->faculty:null;
        $interviews->job_dpt = $request->job_dpt;
        $interviews->title = $request->title;
        $interviews->question_1 = $request->question_1;
        $interviews->question_2 = $request->question_2;
        $interviews->question_3 = $request->question_3;
        $interviews->question_4 = $request->question_4;
        $interviews->question_5 = $request->question_5;
        $interviews->question_6 = $request->question_6;
        $interviews->question_7 = $request->question_7;
        $interviews->question_8 = $request->question_8;
        $interviews->path_1 = 'storage/img/'.$file_name1;
        $interviews->path_2 = 'storage/img/'.$file_name2;
        $interviews->save();

        // 元のページに戻る
        return redirect()->route('show-interview');
    }

    public function updateInterview(Request $request, Interview $interview)
    {

        $file_name1 =null;
        $file_name2 =null;

        // アップロードされたファイル名を取得
        if($request->path_1!=null){
            $file_name1 = $request->file('path_1')->getClientOriginalName();
            $request->file('path_1')->storeAs('public/img', $file_name1);
            $file_name1 = 'storage/img/'.$file_name1;
            $str = $interview->path_1;
            $str = str_replace('storage/img/', '', $str);
            Storage::disk('public')->delete('img/' . $str);
        }else{
            $file_name1 = $interview->path_1;
        }

        if($request->path_2!=null){
            $file_name2 = $request->file('path_2')->getClientOriginalName();
            $request->file('path_2')->storeAs('public/img', $file_name2);
            $file_name2 = 'storage/img/'.$file_name2;
            $str = $interview->path_2;
            $str = str_replace('storage/img/', '', $str);
            Storage::disk('public')->delete('img/' . $str);
        }else{
            $file_name2 = $interview->path_2;
        }


        $interview->update([
            "name" => $request->name,
            "title"=>$request->title,
            "hire_year"=>$request->hire_year,
            "school"=>$request->school,
            "department" => $request->department!=null?$request->department:null,
            "faculty" => $request->faculty!=null?$request->faculty:null,
            "job_dpt" => $request->job_dpt,
            "question_1" => $request->question_1,
            "question_2" => $request->question_2,
            "question_3" => $request->question_3,
            "question_4" => $request->question_4,
            "question_5" => $request->question_5,
            "question_6" => $request->question_6,
            "question_7" => $request->question_7,
            "question_8" => $request->question_8,
            "path_1" => $file_name1,
            "path_2" => $file_name2,
        ]);


        return redirect()->route('show-interview');
    }

    public function deleteInterview(Request $request)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $plan = Interview::find($request->id);
        // レコードを削除
        $plan->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('show-interview');
    }

}
