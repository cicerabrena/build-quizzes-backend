<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['template_id', 'question_id'];

    protected $hidden = ['id', 'deleted_at'];

    /**
     * Define relation with Template table
     *
     * @return HasMany<Template>
     */
    public function templates(): HasMany
    {
        return $this->hasMany(Template::class);
    }   

    /**
     * Define relation with Question table
     *
     * @return HasMany<Question>
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

}
