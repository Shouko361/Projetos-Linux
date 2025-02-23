<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserRoles extends Component
{
    public User $user;
    public $roles;
    public $permissions;
    /**
     * Create a new component instance.
     */
    public function __construct(User $user, $roles = [], $permissions = [])
    {
        $this->user = $user;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-roles');
    }
}
