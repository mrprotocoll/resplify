<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $guard = 'user';
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

    public function roles() : BelongsToMany{
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function resumes(): HasMany {
        return $this->hasMany(Resume::class);
    }

    /**
     * Relationship with resume reviewer
     * @return HasMany
     */
    public function reviews(): HasMany {
        return $this->hasMany(ResumeReview::class, 'reviewer_id');
    }

    /**
     * get the currently logged-in user info
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function current(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::guard('user')->user();
    }

    /**
     * check if a user belongs to the provided role
     * @param RoleEnum $role
     * @return bool
     */
    public function hasRole(RoleEnum $role): bool {
        return $this->roles()->where('name', $role->value)->exists();
    }

    public static function isAdmin(User $user = null): bool
    {
        $user = $user ?? self::current();
        return $user->hasRole(RoleEnum::ADMIN);
    }

    public static function isReviewer(User $user = null): bool
    {
        $user = $user ?? self::current();
        return $user->hasRole(RoleEnum::REVIEWER);
    }

    public static function isUser(User $user = null): bool
    {
        $user = $user ?? self::current();
        return $user->hasRole(RoleEnum::USER);
    }
}
