<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'question_id'];

    protected $hidden = ['id', 'deleted_at'];

    public function templates()
    {
        return $this->hasMany(Template::class);
    }   

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
