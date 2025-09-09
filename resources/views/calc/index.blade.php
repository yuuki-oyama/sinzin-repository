<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>計算アプリ</title>
</head>
<body>
    <h1>計算アプリ</h1>
    <form method="POST" action="/calc">
        @csrf
        <input type="number" name="num1" required>
        <select name="select" required>
            @foreach($dto->getSelect() as $select)
                <option value="{{ $select }}">{{ $select }}</option>
            @endforeach
        </select>
        <input type="number" name="num2" required>

        <button type="submit">送信</button>
    </form>
    @if($dto->getResult() != "")
        {{$dto->getNum1(). $dto->getSelected(). $dto->getNum2(). "=". $dto->getResult()}}<br>
        {{$dto->getMsg()}}
    @endif
    <br><br>
    <div>過去の計算</div>
    <form method="POST" action="/calc">
        @csrf
        <button type="submit">セッション削除</button>
        <input type="hidden" name="clearFlag" value="true">
    </form>
    <ul>
    @foreach($dto->getOldResult() as $oldResult)
       <li>{{ $oldResult }}<br></li>
    @endforeach
    </ul>
</body>
</html>
