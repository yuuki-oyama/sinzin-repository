<?php

namespace App\Http\Controllers;

use App\Dto\CalcDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CalcController extends Controller
{
    // フォーム表示
    public function index()
    {
        // 画面を表示する処理を書く
        $dto = new CalcDto();
        // 初期値のdtoを渡す
        return view('calc.index', ['dto' => $dto]);
    }

    // 計算処理
    public function calculate(Request $request)
    {
        // ここに計算処理を書く
        // インスタンス生成  
        $dto = new CalcDto();

        // formからclearFlagが帰ってきたらセッションクリアして初期値のdtoを渡す
        if($request->input('clearFlag')) {
            Session::forget('resultList');
            return view('calc.index', ['dto' => $dto]);
        }

        // formからのリクエストをインスタンスに設定
        $dto->setNum1($request->input('num1'));
        $dto->setNum2($request->input('num2'));
        $dto->setSelected($request->input('select'));

        // 選択されたセレクトボックスによって処理を分岐
        switch ($dto->getSelected()) {
            // dtoのresutに計算結果を格納
            // 処理ができなかった場合、msgにメッセージを格納
            case '+':
                $dto->setResult($dto->getNum1() + $dto->getNum2());
                break;
            case '-':
                $dto->setResult($dto->getNum1() - $dto->getNum2());
                break;
            case '×':
                $dto->setResult($dto->getNum1() * $dto->getNum2());
                break;
            case '÷':
                if ($dto->getNum2() == 0) {
                    $dto->setResult("ERR");
                    $dto->setMsg("0で割れません");
                    break;
                }
                $dto->setResult($dto->getNum1() / $dto->getNum2());
                break;
            default:
                $dto->setResult("ERR");
                $dto->setMsg("無効です");
        }
        
        // 計算した結果をresultListに保存
        $resultList = [];

        // セッションに値がなかった場合入れない（配列がnullに変換されるため）
        if (!empty(session('resultList'))) {
            // セッションに値があった場合、resultListに格納
            $resultList = session('resultList');
        }

        // resultListに計算結果を追加する（セッションのresultList＋計算結果）
        array_push($resultList, $dto->getNum1() . $dto->getSelected() . $dto->getNum2() . "=" . $dto->getResult());

        // dtoのoldResultにresultListをセット
        $dto->setOldResult($resultList);

        // セッションのresultListを上書き
        session(['resultList' => $resultList]);

        // bladeにインスタンスを渡す
        return view('calc.index', ['dto' => $dto]);
    }
}
