<?php

namespace App\Policies;

use App\Models\About;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPolicy
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
            return auth()->user()->hasPermissionTo('index about')
                ? $this->allow()
                : $this->deny('Cant Open Abouts Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index about')
                ? $this->allow()
                : $this->deny('Cant Open Abouts Table \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('index about')
                ? $this->allow()
                : $this->deny('Cant Open Abouts Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show about')
                ? $this->allow()
                : $this->deny('Cant Open Show About details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show about')
                ? $this->allow()
                : $this->deny('Cant Open Show About details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('show about')
                ? $this->allow()
                : $this->deny('Cant Open Show About details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create about')
                ? $this->allow()
                : $this->deny('Cant Open  "About Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create about')
                ? $this->allow()
                : $this->deny('Cant Open  "About Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create about')
                ? $this->allow()
                : $this->deny('Cant Open  "About Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit about')
                ? $this->allow()
                : $this->deny('Cant Open "About Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit about')
                ? $this->allow()
                : $this->deny('Cant Open "About Edit"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('edit about')
                ? $this->allow()
                : $this->deny('Cant Open "About Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete about')
                ? $this->allow()
                : $this->deny('Cant Open "about delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete about')
                ? $this->allow()
                : $this->deny('Cant Open "about delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete about')
                ? $this->allow()
                : $this->deny('Cant Open "about delete"  Page \ PROHIBITED.');
        }
    }

}