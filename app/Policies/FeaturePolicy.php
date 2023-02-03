<?php

namespace App\Policies;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeaturePolicy
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
            return auth()->user()->hasPermissionTo('index features')
            ? $this->allow()
                : $this->deny('Cant Open features Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index features')
            ? $this->allow()
                : $this->deny('Cant Open features Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index features')
            ? $this->allow()
                : $this->deny('Cant Open features Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show feature')
            ? $this->allow()
                : $this->deny('Cant Open Show feature details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show feature')
            ? $this->allow()
                : $this->deny('Cant Open Show feature details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show feature')
            ? $this->allow()
                : $this->deny('Cant Open Show feature details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create feature')
            ? $this->allow()
                : $this->deny('Cant Open  "feature Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create feature')
            ? $this->allow()
                : $this->deny('Cant Open  "feature Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create feature')
            ? $this->allow()
                : $this->deny('Cant Open  "feature Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit feature')
            ? $this->allow()
                : $this->deny('Cant Open "feature Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit feature')
            ? $this->allow()
                : $this->deny('Cant Open "feature Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('edit feature')
            ? $this->allow()
                : $this->deny('Cant Open "feature Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete feature')
            ? $this->allow()
                : $this->deny('Cant Open "feature delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete feature')
            ? $this->allow()
                : $this->deny('Cant Open "feature delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete feature')
            ? $this->allow()
                : $this->deny('Cant Open "feature delete"  Page \ PROHIBITED.');
        }
    }
}
