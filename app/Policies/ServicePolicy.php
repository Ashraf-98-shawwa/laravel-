<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
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
            return auth()->user()->hasPermissionTo('index services')
                ? $this->allow()
                : $this->deny('Cant Open services Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index services')
                ? $this->allow()
                : $this->deny('Cant Open services Table \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('index services')
                ? $this->allow()
                : $this->deny('Cant Open services Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show service')
                ? $this->allow()
                : $this->deny('Cant Open Show service details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show service')
                ? $this->allow()
                : $this->deny('Cant Open Show service details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('show service')
                ? $this->allow()
                : $this->deny('Cant Open Show service details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create service')
                ? $this->allow()
                : $this->deny('Cant Open  "service Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create service')
                ? $this->allow()
                : $this->deny('Cant Open  "service Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create service')
                ? $this->allow()
                : $this->deny('Cant Open  "service Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit service')
                ? $this->allow()
                : $this->deny('Cant Open "service Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit service')
                ? $this->allow()
                : $this->deny('Cant Open "service Edit"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('edit service')
                ? $this->allow()
                : $this->deny('Cant Open "service Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete service')
                ? $this->allow()
                : $this->deny('Cant Open "service delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete service')
                ? $this->allow()
                : $this->deny('Cant Open "service delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete service')
                ? $this->allow()
                : $this->deny('Cant Open "service delete"  Page \ PROHIBITED.');
        }
    }

}
