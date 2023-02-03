<?php

namespace App\Policies;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
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
            return auth()->user()->hasPermissionTo('index sliders')
                ? $this->allow()
                : $this->deny('Cant Open sliders Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index sliders')
                ? $this->allow()
                : $this->deny('Cant Open sliders Table \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('index sliders')
                ? $this->allow()
                : $this->deny('Cant Open sliders Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show slider')
                ? $this->allow()
                : $this->deny('Cant Open Show slider details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show slider')
                ? $this->allow()
                : $this->deny('Cant Open Show slider details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('show slider')
                ? $this->allow()
                : $this->deny('Cant Open Show slider details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create slider')
                ? $this->allow()
                : $this->deny('Cant Open  "slider Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create slider')
                ? $this->allow()
                : $this->deny('Cant Open  "slider Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create slider')
                ? $this->allow()
                : $this->deny('Cant Open  "slider Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit slider')
                ? $this->allow()
                : $this->deny('Cant Open "slider Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit slider')
                ? $this->allow()
                : $this->deny('Cant Open "slider Edit"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('edit slider')
                ? $this->allow()
                : $this->deny('Cant Open "slider Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete slider')
                ? $this->allow()
                : $this->deny('Cant Open "slider delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete slider')
                ? $this->allow()
                : $this->deny('Cant Open "slider delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete slider')
                ? $this->allow()
                : $this->deny('Cant Open "slider delete"  Page \ PROHIBITED.');
        }
    }

}