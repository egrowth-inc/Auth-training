<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 管理者がユーザーを編集できるかどうか
     */
    public function update(User $admin, User $user)
    {
        return $admin->hasRole('admin');
    }

    /**
     * 管理者がユーザーを削除できるかどうか
     */
    public function delete(User $admin, User $user)
    {
        return $admin->hasRole('admin');
    }
}
