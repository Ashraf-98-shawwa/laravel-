<?php

namespace App\Policies;

use App\Models\Subscriper;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriperPolicy
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
            return auth()->user()->hasPermissionTo('index subscripers')
                ? $this->allow()
                : $this->deny('Cant Open subscripers Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index subscripers')
                ? $this->allow()
                : $this->deny('Cant Open subscripers Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index subscripers')
                ? $this->allow()
                : $this->deny('Cant Open subscripers Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete subscriper')
                ? $this->allow()
                : $this->deny('Cant Open "subscriper Delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete subscriper')
                ? $this->allow()
                : $this->deny('Cant Open "subscriper Delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete subscriper')
                ? $this->allow()
                : $this->deny('Cant Open "subscriper Delete"  Page \ PROHIBITED.');
        }
    }

}