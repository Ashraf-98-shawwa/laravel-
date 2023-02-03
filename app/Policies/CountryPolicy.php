<?php

namespace App\Policies;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
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
            return auth()->user()->hasPermissionTo('index countries')
            ? $this->allow()
                : $this->deny('Cant Open countries Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index countries')
            ? $this->allow()
                : $this->deny('Cant Open countries Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index countries')
            ? $this->allow()
                : $this->deny('Cant Open countries Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show country')
            ? $this->allow()
                : $this->deny('Cant Open Show country details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show country')
            ? $this->allow()
                : $this->deny('Cant Open Show country details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show country')
            ? $this->allow()
                : $this->deny('Cant Open Show country details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create country')
            ? $this->allow()
                : $this->deny('Cant Open  "country Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create country')
            ? $this->allow()
                : $this->deny('Cant Open  "country Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create country')
            ? $this->allow()
                : $this->deny('Cant Open  "country Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit country')
            ? $this->allow()
                : $this->deny('Cant Open "country Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit country')
            ? $this->allow()
                : $this->deny('Cant Open "country Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('edit country')
            ? $this->allow()
                : $this->deny('Cant Open "country Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete country')
            ? $this->allow()
                : $this->deny('Cant Open "country delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete country')
            ? $this->allow()
                : $this->deny('Cant Open "country delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete country')
            ? $this->allow()
                : $this->deny('Cant Open "country delete"  Page \ PROHIBITED.');
        }
    }
}
