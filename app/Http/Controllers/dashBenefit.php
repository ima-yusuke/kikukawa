<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Benefit;
use App\Models\BenefitContent;
use Illuminate\Support\Facades\DB;

class dashBenefit extends Controller
{

    public function getCountAmount()
    {
        return DB::table('benefit_contents')
            ->select('benefit_id')
            ->selectRaw('COUNT(benefit_id) as benefit_id')
            ->groupBy('benefit_id')
            ->get();
    }
    //
    public function showBenefitPage()
    {

        $benefits = Benefit::all();

        $tmp_column_count = 0;
        $column_count = $this->getCountAmount();
        foreach($column_count as $key =>$value){
            if($value->benefit_id>$tmp_column_count){
                $tmp_column_count = $value->benefit_id;
            }
        }

        return view("benefits",compact("benefits","tmp_column_count"));
    }

    public function addBenefit(Request $request)
    {

        $benefits = new Benefit();
        $benefits->title = $request->title;
        $benefits->save();

        $tmpCount = 0;
        $tmpArray = $request->all();

        foreach ($tmpArray as $key=> $value){
            if (strpos($key, 'info_content')!==false){
                $tmpCount++;
            }
        }

        for($i=1;$i<=$tmpCount;$i++){
            $benefit_contents = new BenefitContent();
            $benefit_contents->benefit_id =$benefits->id;
            $tmp_title ="info_title".$i;
            $tmp_content ="info_content".$i;
            if( $request->$tmp_title !=null){
                $benefit_contents->benefit_title = $request->$tmp_title;
            }
            $benefit_contents->benefit_content =$request->$tmp_content;
            $benefit_contents->save();
        }

        // 元のページに戻る
        return redirect()->route('show-benefit');
    }

    public function updateBenefit(Request $request, Benefit $benefit , BenefitContent $benefitContent)
    {

        //Benefit table update
        $benefit->update([
            "title" => $request->title,
        ]);

        //BenefitContent table update

        //クリックされたbenefit_idを持つデータを全てDBから取得
        $plans = BenefitContent::where("benefit_id",$request->benefit_id)->get();

        //既にDBにあるのをupdate
        $count = 0;
        foreach ($plans as $plan){
            $count++;
            $tmp_title ="info_title".$count;
            $tmp_content ="info_content".$count;

            if($request[$tmp_title]!=null){
                $plan->update([
                    "benefit_title"=>$request[$tmp_title]
                ]);
            }else{
                $plan->update([
                    "benefit_title" =>null
                ]);
            }

            if($request[$tmp_content]!=null){
                $plan->update([
                    "benefit_content" =>$request[$tmp_content]
                ]);
            }
        }

        //最大の募集職種数を取得
        $tmp_column_count = 0;
        $column_count = $this->getCountAmount();
        foreach($column_count as $key =>$value){
            if($value->benefit_id>$tmp_column_count){
                $tmp_column_count = $value->benefit_id;
            }
        }

        //$requestの中でnullでないinfo_contentを含んでる数を計算
        $selectedTr_content_count =0;
        for ($i=1;$i<=$tmp_column_count;$i++){
            $tmp_content ="info_content".$i;
            if($request->$tmp_content!=null){
                $selectedTr_content_count++;
            }
        }

        //もともとnullで新規でデータを入力し追加
        for($i=$count;$i<$selectedTr_content_count;$i++){
            $benefit_contents = new BenefitContent();
            $benefit_contents->benefit_id =$request->id ;
            $tmp_title ="info_title".$i+1;
            $tmp_content ="info_content".$i+1;
            $benefit_contents->benefit_title =$request->$tmp_title;


            if( $request->$tmp_content!=null){
                $benefit_contents->benefit_content = $request->$tmp_content;
            }
            $benefit_contents->save();


        }


        return redirect()->route('show-benefit');
    }

    public function deleteBenefit(Request $request)
    {
        $plan = Benefit::find($request->id);
        // レコードを削除
        $plan->delete();

        $plans = BenefitContent::where("benefit_id",$request->id)->get();
        // レコードを削除

        foreach ($plans as $plan){
            $plan->delete();
        }

        return redirect()->route('show-benefit');
    }
}
