<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    public function admin(): BelongsTo{
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
