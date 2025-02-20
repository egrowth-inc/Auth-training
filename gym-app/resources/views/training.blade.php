<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トレーニング情報 - {{ $muscleData->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <h1>トレーニング情報</h1>
        <h2>{{ $muscleData->name }}</h2>

        <div class="training-image">
            <img src="{{ asset('images/' . $muscleData->image) }}" alt="{{ $muscleData->name }}のトレーニング画像">
        </div>

        <a href="/" class="btn">戻る</a>
    </div>
</body>

</html>
