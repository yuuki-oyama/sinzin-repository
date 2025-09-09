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
        return view('calc.index', ['dto' => $dto]);
    }

    // 計算処理
    public function calculate(Request $request)
    {
        // ここに計算処理を書く
        $dto = new CalcDto();
        if($request->input('clearFlag')) {
            Session::forget('resultList');
            return view('calc.index', ['dto' => $dto]);
        }
        $dto->setNum1($request->input('num1'));
        $dto->setNum2($request->input('num2'));
        $dto->setSelected($request->input('select'));

        switch ($dto->getSelected()) {
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

        $resultList = [];
        if (!empty(session('resultList'))) {
            $resultList = session('resultList');
        }

        array_push($resultList, $dto->getNum1() . $dto->getSelected() . $dto->getNum2() . "=" . $dto->getResult());
        $dto->setOldResult($resultList);
        session(['resultList' => $resultList]);

        return view('calc.index', ['dto' => $dto]);
    }
}
