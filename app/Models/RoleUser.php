<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * creates many-to-many relationship between role and users in role_user table
 */
class RoleUser extends Model
{
    use HasFactory;
}
