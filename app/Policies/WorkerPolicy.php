<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkerPolicy
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
            return auth()->user()->hasPermissionTo('index workers')
            ? $this->allow()
                : $this->deny('Cant Open workers Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index workers')
            ? $this->allow()
                : $this->deny('Cant Open workers Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index workers')
            ? $this->allow()
                : $this->deny('Cant Open workers Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show worker')
            ? $this->allow()
                : $this->deny('Cant Open Show worker details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show worker')
            ? $this->allow()
                : $this->deny('Cant Open Show worker details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show worker')
            ? $this->allow()
                : $this->deny('Cant Open Show worker details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create worker')
            ? $this->allow()
                : $this->deny('Cant Open  "worker Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create worker')
            ? $this->allow()
                : $this->deny('Cant Open  "worker Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create worker')
            ? $this->allow()
                : $this->deny('Cant Open  "worker Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit worker')
            ? $this->allow()
                : $this->deny('Cant Open "worker Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit worker')
            ? $this->allow()
                : $this->deny('Cant Open "worker Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('edit worker')
            ? $this->allow()
                : $this->deny('Cant Open "worker Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete worker')
            ? $this->allow()
                : $this->deny('Cant Open "worker delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete worker')
            ? $this->allow()
                : $this->deny('Cant Open "worker delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete worker')
            ? $this->allow()
                : $this->deny('Cant Open "worker delete"  Page \ PROHIBITED.');
        }
    }
}