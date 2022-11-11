<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $fillable = ['type_id', 'subquestion_id', 'alternative_id', 'name'];

    protected $hidden = ['id', 'deleted_at'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function subquestion()
    {
        return $this->hasOne(Subquestion::class);
    }

    public function alternative()
    {
        return $this->hasOne(Alternative::class);
    }
}
