<?php

namespace App\Models;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

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
        'role_id',
        'phone',
        'google_user_id'
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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    // public function hasPermission($permission)
    // {
    //     return $this->roles->flatMap->permissions->pluck('name')->contains($permission);
    // }


    public static function createUser($userData, $roleId)
    {
        $userData['password'] = Hash::make($userData['password']);

        $user = self::create($userData);

        if ($user) {
            $user->roles()->attach($roleId);
        }

        return $user;
    }

    public function calculateTotalAmount()
    {
        $totalAmount = Order::where('user_id', $this->id)->sum('total');
        return $totalAmount;
    }
}
