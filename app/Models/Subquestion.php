<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subquestion extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'name'];

    protected $hidden = ['id', 'deleted_at'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
