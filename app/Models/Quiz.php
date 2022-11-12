<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'identification',
        'subject_id',
        'template_id',
        'user_id',
        'name',
        'description'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    /**
     * Define relation with Subject table
     *
     * @return BelongsTo<Subject, Quiz>
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Define relation with Template table
     *
     * @return HasOne<Template>
     */
    public function template(): HasOne
    {
        return $this->hasOne(Template::class);
    }

    /**
     * Define relation with User table
     *
     * @return BelongsTo<User, Quiz>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
