<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
            return auth()->user()->hasPermissionTo('index projects')
            ? $this->allow()
                : $this->deny('Cant Open projects Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index projects')
            ? $this->allow()
                : $this->deny('Cant Open projects Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index projects')
            ? $this->allow()
                : $this->deny('Cant Open projects Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show project')
            ? $this->allow()
                : $this->deny('Cant Open Show project details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show project')
            ? $this->allow()
                : $this->deny('Cant Open Show project details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show project')
            ? $this->allow()
                : $this->deny('Cant Open Show project details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create project')
            ? $this->allow()
                : $this->deny('Cant Open  "project Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create project')
            ? $this->allow()
                : $this->deny('Cant Open  "project Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create project')
            ? $this->allow()
                : $this->deny('Cant Open  "project Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit project')
            ? $this->allow()
                : $this->deny('Cant Open "project Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit project')
            ? $this->allow()
                : $this->deny('Cant Open "project Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('edit project')
            ? $this->allow()
                : $this->deny('Cant Open "project Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete project')
            ? $this->allow()
                : $this->deny('Cant Open "project delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete project')
            ? $this->allow()
                : $this->deny('Cant Open "project delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete project')
            ? $this->allow()
                : $this->deny('Cant Open "project delete"  Page \ PROHIBITED.');
        }
    }
}
