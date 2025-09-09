<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>計算アプリ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column align-items-center gap-3">
    <h1 class="mt-5">計算アプリ</h1>
    {{-- フォームの中にほしい値を入れる --}}
    <form method="POST" action="/calc">
        <div class="d-flex">
            @csrf
            {{-- 数字1 --}}
            <input type="number" class="text-primary mb-4" name="num1" required>

            {{-- dtoで持っている配列selectをforeachで表示 --}}
            <select name="select" class="form-select mb-3" style="width:100px" required>
                @foreach($dto->getSelect() as $select)
                    <option value="{{ $select }}">{{ $select }}</option>
                @endforeach
            </select>

            {{-- 数字2 --}}
            <input type="number" name="num2" class="text-primary mb-4" required>

            {{-- ボタン --}}
        </div>
        <button type="submit" class="btn btn-primary d-block mx-auto">送信</button>
    </form>

    {{-- 計算結果を表示（dtoに保存したそれぞれの結果を繋げて表示） --}}
    @if($dto->getResult() != "")
        <div class="fw-bold text-primary fs-4 mb-2">{{$dto->getNum1(). $dto->getSelected(). $dto->getNum2(). "=". $dto->getResult()}}</div>
        <div class="fw-bold text-primary fs-4 mb-2">{{$dto->getMsg()}}</div>
    @endif

    <div class="text-dark">過去の計算</div>
    {{-- セッション削除用ボタン --}}
    <form method="POST" action="/calc">
        @csrf
        <button type="submit" class="btn btn-primary">セッション削除</button>
        {{-- clearFlagを渡す --}}
        <input type="hidden" name="clearFlag" value="true">
    </form>

    {{-- 配列に入れていたoldResultを表示 --}}
    <ul class="mb-3">
        @foreach($dto->getOldResult() as $oldResult)
            <li class="text-dark">{{ $oldResult }}<br></li>
        @endforeach
    </ul>
</body>
</html>
