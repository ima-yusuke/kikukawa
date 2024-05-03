<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class dashQuestion extends Controller
{
    //
    public function showQuestionPage()
    {
        $questions = Question::all();

        return view("questions",compact("questions"));
    }

    public function addQuestion(Request $request)
    {

        $questions = new Question();
        $questions->question = $request->question;
        $questions->answer = $request->answer;
        $questions->save();


        // 元のページに戻る
        return redirect()->route('show-question');
    }

    public function updateQuestion(Request $request, Question $question)
    {


        $question->update([
            "question" => $request->question,
            "answer"=>$request->answer,
        ]);

        return redirect()->route('show-question');
    }

    public function deleteQuestion(Request $request)
    {
        $plan = Question::find($request->id);
        // レコードを削除
        $plan->delete();

        return redirect()->route('show-question');
    }

}
