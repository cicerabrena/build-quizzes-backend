<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identification',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define relation with Subject table
     *
     * @return HasMany<Subject>
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
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
    
    /**
     * Define relation with Template table
     *
     * @return HasMany<Template>
     */
    public function templates(): HasMany
    {
        return $this->hasMany(Template::class);
    }
    
}
