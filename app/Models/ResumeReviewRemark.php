<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ResumeReviewRemark extends Model
{
    use HasFactory;

    protected $table = 'resume_review_remarks';

//    public function reviews(): BelongsToMany{
//        return $this->
//    }
}
