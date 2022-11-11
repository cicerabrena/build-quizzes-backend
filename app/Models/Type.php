<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'identification'];

    protected $hidden = ['id', 'deleted_at'];

    public function subquestions()
    {
        return $this->hasMany(Subquestion::class);
    }

}
