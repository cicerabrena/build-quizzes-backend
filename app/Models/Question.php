<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'identification',
        'type_id',
        'subquestion_id',
        'alternative_id',
        'name'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    /**
     * Define relation with Type table
     *
     * @return BelongsTo<Type, Question>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Define relation with Subquestion table
     *
     * @return HasOne<Subquestion>
     */
    public function subquestion(): HasOne
    {
        return $this->hasOne(Subquestion::class);
    }

    /**
     * Define relation with Alternative table
     *
     * @return HasOne<Alternative>
     */
    public function alternative(): HasOne
    {
        return $this->hasOne(Alternative::class);
    }
}
