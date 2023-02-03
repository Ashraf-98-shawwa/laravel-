<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
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
            return auth()->user()->hasPermissionTo('index contacts')
            ? $this->allow()
                : $this->deny('Cant Open contacts Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index contacts')
            ? $this->allow()
                : $this->deny('Cant Open contacts Table \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('index contacts')
            ? $this->allow()
                : $this->deny('Cant Open contacts Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show contact')
            ? $this->allow()
                : $this->deny('Cant Open Show contact details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show contact')
            ? $this->allow()
                : $this->deny('Cant Open Show contact details Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('show contact')
            ? $this->allow()
                : $this->deny('Cant Open Show contact details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete contact')
            ? $this->allow()
                : $this->deny('Cant Open "contact delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete contact')
            ? $this->allow()
                : $this->deny('Cant Open "contact delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete contact')
            ? $this->allow()
                : $this->deny('Cant Open "contact delete"  Page \ PROHIBITED.');
        }
    }
}
