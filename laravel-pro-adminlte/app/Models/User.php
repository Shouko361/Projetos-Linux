<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpKernel\Profiler\Profile;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function interest(){
        return $this->hasMany(UserInterest::class);
    }

    public function hasDirectPermissionRole($permission)
    {
        // Verificar permissões atribuídas diretamente ao usuário
        return $this->hasPermissionTo($permission);
    }


    public function canOverride($permission)
    {
//        dd($this->hasPermissionTo('view users'));
        if ($this->hasDirectPermissionRole($permission)) {
            return true;
        }

        return $this->hasPermissionTo($permission);
    }
}
