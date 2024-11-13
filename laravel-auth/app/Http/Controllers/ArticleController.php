<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * 記事の編集画面を表示
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        // パーミッションチェック（オプション）
        if (!auth()->user()->can('edit articles')) {
            abort(403, 'Unauthorized action.');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * 記事の更新処理
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // パーミッションチェック
        $this->authorize('edit articles');

        // 更新処理
        $article->update($request->all());

        return redirect()->route('articles.show', $id);
    }
}
