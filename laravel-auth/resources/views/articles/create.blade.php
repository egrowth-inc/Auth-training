<!DOCTYPE html>
<html>

<head>
    <title>記事の作成</title>
</head>

<body>
    <h1>新しい記事を作成</h1>
    <form action="/articles" method="POST">
        @csrf
        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" required><br><br>
        <label for="content">内容:</label>
        <textarea id="content" name="content" required></textarea><br><br>
        <button type="submit">作成</button>
    </form>
</body>

</html>
