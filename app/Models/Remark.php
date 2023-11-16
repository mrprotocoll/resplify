<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Remark extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function admin(): BelongsTo{
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function reviews(): BelongsToMany{
        return $this->belongsToMany(ResumeReview::class)->withTimestamps()->withPivot(['description', 'score']);
    }
}
