<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
 * Check if user is the Super Admin.
 *
 * @return bool
 */
    public function isSuperAdmin(): bool
    {
        $role = Role::where('role', 'Super Admin')
            ->where('user_id', $this->id)
            ->first();
            
        return !$role ? false : true;
    }

    /**
    * Check if user is the Admin of the Domain.
    *
    * @param Domain $domain
    * @return bool
    */
    public function isAdmin(Domain $domain): bool
    {
        $role = Role::where('role', 'admin')
            ->where('domain_id', $domain->id)
            ->where('user_id', $this->id)
            ->first();

        return $role ? true : $this->isSuperAdmin();
    }
}
