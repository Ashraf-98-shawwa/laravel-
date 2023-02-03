<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
            return auth()->user()->hasPermissionTo('index articles')
                ? $this->allow()
                : $this->deny('Cant Open Articles Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index articles')
                ? $this->allow()
                : $this->deny('Cant Open Articles Table \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('index articles')
                ? $this->allow()
                : $this->deny('Cant Open Articles Table \ PROHIBITED.');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('show article')
                ? $this->allow()
                : $this->deny('Cant Open Show Article details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show article')
                ? $this->allow()
                : $this->deny('Cant Open Show Article details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('show article')
                ? $this->allow()
                : $this->deny('Cant Open Show Article details Page \ PROHIBITED.');
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('create article')
                ? $this->allow()
                : $this->deny('Cant Open  "Article Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create article')
                ? $this->allow()
                : $this->deny('Cant Open  "Article Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create article')
                ? $this->allow()
                : $this->deny('Cant Open  "Article Create" Page \ PROHIBITED.');
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update()
    {
        if (auth('admin')->check()) {
            return auth()->user()->hasPermissionTo('edit article')
                ? $this->allow()
                : $this->deny('Cant Open "Article Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit article')
                ? $this->allow()
                : $this->deny('Cant Open "Article Edit"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('edit article')
                ? $this->allow()
                : $this->deny('Cant Open "Article Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete article')
                ? $this->allow()
                : $this->deny('Cant Open "Article delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete article')
                ? $this->allow()
                : $this->deny('Cant Open "Article delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete article')
                ? $this->allow()
                : $this->deny('Cant Open "Article delete"  Page \ PROHIBITED.');
        }
    }
}