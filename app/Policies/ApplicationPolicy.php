<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
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
            return auth()->user()->hasPermissionTo('index requests')
            ? $this->allow()
                : $this->deny('Cant Open requests Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index requests')
            ? $this->allow()
                : $this->deny('Cant Open requests Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index requests')
            ? $this->allow()
                : $this->deny('Cant Open requests Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show request')
            ? $this->allow()
                : $this->deny('Cant Open Show request details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show request')
            ? $this->allow()
                : $this->deny('Cant Open Show request details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show request')
            ? $this->allow()
                : $this->deny('Cant Open Show request details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete request')
            ? $this->allow()
                : $this->deny('Cant Open "request delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete request')
            ? $this->allow()
                : $this->deny('Cant Open "request delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete request')
            ? $this->allow()
                : $this->deny('Cant Open "request delete"  Page \ PROHIBITED.');
        }
    }
}