<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name'
    ];

    // create relationship with users
    public function users() : BelongsToMany{
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * get a role
     * @param RoleEnum $role
     * @return Role
     */
    public static function get(RoleEnum $role): Role {
        return self::where('name', $role)->first();
    }

}
