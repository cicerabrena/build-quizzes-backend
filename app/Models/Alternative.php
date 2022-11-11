<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'subquestion_id', 'name'];

    protected $hidden = ['id', 'deleted_at'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function subquestions()
    {
        return $this->hasMany(Subquestion::class);
    }

}
