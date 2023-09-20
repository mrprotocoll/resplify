<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ResumeReview extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'reviewer',
        'resume',
        'summary'
    ];

    public function resume(): BelongsTo{
        return $this->belongsTo(Resume::class);
    }

    public function reviewer(): BelongsTo{
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function remarks(): BelongsToMany{
        return $this->belongsToMany(Remark::class)->withTimestamps()->withPivot(['description', 'score']);
    }

}
