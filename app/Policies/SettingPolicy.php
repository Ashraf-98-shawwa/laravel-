<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
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
            return auth()->user()->hasPermissionTo('Index setting')
            ? $this->allow()
                : $this->deny('Cant Open settings Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('Index setting')
            ? $this->allow()
                : $this->deny('Cant Open settings Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('Index setting')
            ? $this->allow()
                : $this->deny('Cant Open settings Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show setting')
            ? $this->allow()
                : $this->deny('Cant Open Show setting details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show setting')
            ? $this->allow()
                : $this->deny('Cant Open Show setting details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('show setting')
            ? $this->allow()
                : $this->deny('Cant Open Show setting details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create setting')
            ? $this->allow()
                : $this->deny('Cant Open  "setting Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create setting')
            ? $this->allow()
                : $this->deny('Cant Open  "setting Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create setting')
            ? $this->allow()
                : $this->deny('Cant Open  "setting Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit setting')
            ? $this->allow()
                : $this->deny('Cant Open "setting Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit setting')
            ? $this->allow()
                : $this->deny('Cant Open "setting Edit"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('edit setting')
            ? $this->allow()
                : $this->deny('Cant Open "setting Edit"  Page \ PROHIBITED.');
        }
}
}
