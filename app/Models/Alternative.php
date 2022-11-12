<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternative extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'question_id',
        'subquestion_id',
        'name'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    /**
     * Define relation with Question table
     *
     * @return HasMany<Question>
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Define relation with Subquestion table
     *
     * @return HasMany<Subquestion>
     */
    public function subquestions(): HasMany
    {
        return $this->hasMany(Subquestion::class);
    }

}
