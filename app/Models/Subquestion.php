<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subquestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'identification',
        'type_id',
        'name'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];


    /**
     * Define relatio with Type table
     *
     * @return BelongsTo<Type, Subquestion>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
