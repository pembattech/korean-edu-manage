<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamScore extends Model
{

    protected $fillable = [
        'candidate_id',
        'exam_start_time',
        'korean_score',
        'set_number'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}