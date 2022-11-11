<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'user_id'];

    protected $hidden = ['id', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
