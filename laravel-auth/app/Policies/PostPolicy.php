<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * 全てのユーザーに対する前処理
     */
    public function before(User $user, $ability)
    {
        // 管理者は全ての操作を許可
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * 投稿の表示を許可するか
     */
    public function view(User $user, Post $post)
    {
        return true; // すべてのユーザーが投稿を閲覧可能
    }

    /**
     * 投稿の作成を許可するか
     */
    public function create(User $user)
    {
        return $user->hasPermission('create post');
    }

    /**
     * 投稿の更新を許可するか
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * 投稿の削除を許可するか
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
