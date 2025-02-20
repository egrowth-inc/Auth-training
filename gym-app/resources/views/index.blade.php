<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>筋トレマップ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container">
    <h1>筋トレしよう！！</h1>
        <!-- 人体画像 -->
        <div class="image-container" style="position: relative;">
            <img src="{{ asset('images/human-body.png') }}" alt="人体図" class="human-body">

            <!-- クリック可能なエリア -->
            <div class="muscle chest" id="chest"></div>
            <div class="muscle abs" id="abs"></div>
            <div class="muscle legs" id="legs"></div>
        </div>

    </div>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>