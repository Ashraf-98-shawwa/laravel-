<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
            return auth()->user()->hasPermissionTo('index categories')
                ? $this->allow()
                : $this->deny('Cant Open Categories Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index categories')
                ? $this->allow()
                : $this->deny('Cant Open Categories Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index categories')
                ? $this->allow()
                : $this->deny('Cant Open Categories Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show category')
                ? $this->allow()
                : $this->deny('Cant Open Show category details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show category')
                ? $this->allow()
                : $this->deny('Cant Open Show category details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show category')
                ? $this->allow()
                : $this->deny('Cant Open Show category details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create category')
                ? $this->allow()
                : $this->deny('Cant Open  "category Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create category')
                ? $this->allow()
                : $this->deny('Cant Open  "category Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create category')
                ? $this->allow()
                : $this->deny('Cant Open  "category Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit category')
                ? $this->allow()
                : $this->deny('Cant Open "category Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit category')
                ? $this->allow()
                : $this->deny('Cant Open "category Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('edit category')
                ? $this->allow()
                : $this->deny('Cant Open "category Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete category')
                ? $this->allow()
                : $this->deny('Cant Open "category delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete category')
                ? $this->allow()
                : $this->deny('Cant Open "category delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete category')
                ? $this->allow()
                : $this->deny('Cant Open "category delete"  Page \ PROHIBITED.');
        }
    }

}
