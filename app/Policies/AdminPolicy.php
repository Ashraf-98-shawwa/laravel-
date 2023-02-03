<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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
            return auth()->user()->hasPermissionTo('Index Admins')
                ? $this->allow()
                : $this->deny('Cant Open Admins Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Index Admins')
                ? $this->allow()
                : $this->deny('Cant Open Admins Table \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('Index Admins')
                ? $this->allow()
                : $this->deny('Cant Open Admins Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Show Admin')
                ? $this->allow()
                : $this->deny('Cant Open Show Admin details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Show Admin')
                ? $this->allow()
                : $this->deny('Cant Open Show Admin details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('Show Admin')
                ? $this->allow()
                : $this->deny('Cant Open Show Admin details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Create Admin')
                ? $this->allow()
                : $this->deny('Cant Open  "Admin Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Create Admin')
                ? $this->allow()
                : $this->deny('Cant Open  "Admin Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('Create Admin')
                ? $this->allow()
                : $this->deny('Cant Open  "Admin Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Edit Admin')
                ? $this->allow()
                : $this->deny('Cant Open "Admin Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Edit Admin')
                ? $this->allow()
                : $this->deny('Cant Open "Admin Edit"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('Edit Admin')
                ? $this->allow()
                : $this->deny('Cant Open "Admin Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('Delete Admin')
            ? $this->allow()
            : $this->deny('Cant Open "Admin Delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Delete Admin')
            ? $this->allow()
            : $this->deny('Cant Open "Admin Delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('Delete Admin')
            ? $this->allow()
            : $this->deny('Cant Open "Admin Delete"  Page \ PROHIBITED.');
        }

    }

}
