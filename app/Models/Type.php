<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasUuid;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    /**
     * Define relation with Subquestion table
     *
     * @return HasMany<Subquestion>
     */
    public function subquestions(): HasMany
    {
        return $this->hasMany(Subquestion::class);
    }

    /**
     * Define relation with Quiz table
     *
     * @return HasMany<Quiz>
     */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

}
