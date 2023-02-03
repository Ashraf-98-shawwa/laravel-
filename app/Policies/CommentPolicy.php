<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {

        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('index comments')
                ? $this->allow()
                : $this->deny('Cant Open comments Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index comments')
                ? $this->allow()
                : $this->deny('Cant Open comments Table \ PROHIBITED.');
        } elseif (auth('admin-api')->check()) {
            return auth()->user()->hasPermissionTo('index comments')
                ? $this->allow()
                : $this->deny('Cant Open comments Table \ PROHIBITED.');
        } elseif (auth('author-api')->check()) {
            return auth()->user()->hasPermissionTo('index comments')
                ? $this->allow()
                : $this->deny('Cant Open comments Table \ PROHIBITED.');
        }else {
            return auth()->user()->hasPermissionTo('index comments')
                ? $this->allow()
                : $this->deny('Cant Open comments Table \ PROHIBITED.');
        }
    }


    public function create()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('create comment')
            ? $this->allow()
                : $this->deny('Cant Create Comment \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create comment')
            ? $this->allow()
                : $this->deny('Cant Create Comment \ PROHIBITED.');
        } elseif (auth('admin-api')->check()) {
            return auth()->user()->hasPermissionTo('create comment')
            ? $this->allow()
                : $this->deny('Cant Create Comment \ PROHIBITED.');
        } elseif (auth('author-api')->check()) {
            return auth()->user()->hasPermissionTo('create comment')
            ? $this->allow()
                : $this->deny('Cant Create Comment \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('create comment')
            ? $this->allow()
                : $this->deny('Cant Create Comment \ PROHIBITED.');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('delete comment')
                ? $this->allow()
                : $this->deny('Cant Open "comment delete"  Page \ PROHIBITED.');
        } elseif (auth('admin-api')->check()) {
            return auth()->user()->hasPermissionTo('delete comment')
                ? $this->allow()
                : $this->deny('Cant Open "comment delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete comment')
                ? $this->allow()
                : $this->deny('Cant Open "comment delete"  Page \ PROHIBITED.');
        } elseif (auth('author-api')->check()) {
            return auth()->user()->hasPermissionTo('delete comment')
            ? $this->allow()
                : $this->deny('Cant Open "comment delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete comment')
                ? $this->allow()
                : $this->deny('Cant Open "comment delete"  Page \ PROHIBITED.');
        }
    }
}
