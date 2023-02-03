<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
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
            return auth()->user()->hasPermissionTo('index testimonials')
            ? $this->allow()
                : $this->deny('Cant Open testimonials Table \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('index testimonials')
            ? $this->allow()
                : $this->deny('Cant Open testimonials Table \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('index testimonials')
            ? $this->allow()
                : $this->deny('Cant Open testimonials Table \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('show testimonial')
            ? $this->allow()
                : $this->deny('Cant Open Show testimonial details Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('show testimonial')
            ? $this->allow()
                : $this->deny('Cant Open Show testimonial details Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('show testimonial')
            ? $this->allow()
                : $this->deny('Cant Open Show testimonial details Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('create testimonial')
            ? $this->allow()
                : $this->deny('Cant Open  "testimonial Create" Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('create testimonial')
            ? $this->allow()
                : $this->deny('Cant Open  "testimonial Create" Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('create testimonial')
            ? $this->allow()
                : $this->deny('Cant Open  "testimonial Create" Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('edit testimonial')
            ? $this->allow()
                : $this->deny('Cant Open "testimonial Edit"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('edit testimonial')
            ? $this->allow()
                : $this->deny('Cant Open "testimonial Edit"  Page \ PROHIBITED.');
        } else {
            return auth()->user()->hasPermissionTo('edit testimonial')
            ? $this->allow()
                : $this->deny('Cant Open "testimonial Edit"  Page \ PROHIBITED.');
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
            return auth()->user()->hasPermissionTo('delete testimonial')
            ? $this->allow()
                : $this->deny('Cant Open "testimonial delete"  Page \ PROHIBITED.');
        } elseif (auth('author')->check()) {
            return auth()->user()->hasPermissionTo('delete testimonial')
            ? $this->allow()
                : $this->deny('Cant Open "testimonial delete"  Page \ PROHIBITED.');
        } else {
            return  auth()->user()->hasPermissionTo('delete testimonial')
            ? $this->allow()
                : $this->deny('Cant Open "testimonial delete"  Page \ PROHIBITED.');
        }
    }
}