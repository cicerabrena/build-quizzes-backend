<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'identification',
        'user_id',
        'subject_id',
        'question_id',
        'name',
        'description'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    /**
     * Define relation with User table
     *
     * @return BelongsTo<User, Template>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define relation with Subject table
     *
     * @return BelongsTo<Subject, Template>
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
