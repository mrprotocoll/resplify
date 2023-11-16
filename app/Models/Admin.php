<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory, HasUuids;

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
     * Relationship with ADMIN
     * @return HasMany
     */
    public function remarks(): HasMany {
        return $this->hasMany(Remark::class, 'admin_id');
    }

    public function categories(): HasMany {
        return $this->hasMany(Category::class, 'admin_id');
    }

    public static function current(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
}
