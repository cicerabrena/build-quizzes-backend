<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'template_id', 'user_id', 'name', 'description'];

    protected $hidden = ['id', 'deleted_at'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function template()
    {
        return $this->hasOne(Template::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
