<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
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
            return auth()->user()->hasPermissionTo('Index Authors')
            ? $this->allow()
                : $this->deny('Cant Open Authors Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Index Authors')
            ? $this->allow()
                : $this->deny('Cant Open Authors Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('Index Authors')
            ? $this->allow()
                : $this->deny('Cant Open Authors Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Show Author')
            ? $this->allow()
                : $this->deny('Cant Open Show Author details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Show Author')
            ? $this->allow()
                : $this->deny('Cant Open Show Author details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('Show Author')
            ? $this->allow()
                : $this->deny('Cant Open Show Author details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Create Author')
            ? $this->allow()
                : $this->deny('Cant Open  "Author Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Create Author')
            ? $this->allow()
                : $this->deny('Cant Open  "Author Create" Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('Create Author')
            ? $this->allow()
                : $this->deny('Cant Open  "Author Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Edit Author')
            ? $this->allow()
                : $this->deny('Cant Open "Author Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Edit Author')
            ? $this->allow()
                : $this->deny('Cant Open "Author Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('Edit Author')
            ? $this->allow()
                : $this->deny('Cant Open "Author Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Delete Author')
            ? $this->allow()
                : $this->deny('Cant Open "Author delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Delete Author')
            ? $this->allow()
                : $this->deny('Cant Open "Author delete"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('Delete Author')
            ? $this->allow()
                : $this->deny('Cant Open "Author delete"  Page \ PROHIBITED.');
        }
    }
}
