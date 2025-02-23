<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserPermissions extends Component
{
    public User $user;
    public $permission;
    /**
     * Create a new component instance.
     */
    public function __construct(User $user, $permission)
    {
        $this->user = $user;
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-permissions');
    }
}
