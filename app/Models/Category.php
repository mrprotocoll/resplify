<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
