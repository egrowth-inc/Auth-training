<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * 投稿の表示
     */
    public function show(Post $post)
    {
        // 認可: ユーザーがこの投稿を表示する権限があるか
        $this->authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    /**
     * 投稿の作成フォームの表示
     */
    public function create()
    {
        // 認可: ユーザーが投稿を作成する権限があるか
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    /**
     * 投稿の保存
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        // バリデーションと投稿の保存
    }

    /**
     * 投稿の編集フォームの表示
     */
    public function edit(Post $post)
    {
        // 認可: ユーザーがこの投稿を編集する権限があるか
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * 投稿の更新
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // バリデーションと投稿の更新
    }

    /**
     * 投稿の削除
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // 投稿の削除
    }
}
