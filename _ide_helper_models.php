<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Alternative
 *
 * @property int $id
 * @property string $identification
 * @property int|null $question_id
 * @property int|null $subquestion_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subquestion[] $subquestions
 * @property-read int|null $subquestions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative newQuery()
 * @method static \Illuminate\Database\Query\Builder|Alternative onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereSubquestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alternative whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Alternative withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Alternative withoutTrashed()
 * @mixin \Eloquent
 */
	class Alternative extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property string $identification
 * @property int $type_id
 * @property int|null $subquestion_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $alternative_id Fill only when question has subquestion
 * @property-read \App\Models\Alternative|null $alternative
 * @property-read \App\Models\Subquestion|null $subquestion
 * @property-read \App\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|Question onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereAlternativeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSubquestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Question withoutTrashed()
 * @mixin \Eloquent
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Quiz
 *
 * @property int $id
 * @property string $identification
 * @property int $user_id
 * @property int $subject_id
 * @property int|null $template_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\Template|null $template
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newQuery()
 * @method static \Illuminate\Database\Query\Builder|Quiz onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Quiz withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Quiz withoutTrashed()
 * @mixin \Eloquent
 */
	class Quiz extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuizQuestion
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $question_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quiz[] $quizzes
 * @property-read int|null $quizzes_count
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion newQuery()
 * @method static \Illuminate\Database\Query\Builder|QuizQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|QuizQuestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|QuizQuestion withoutTrashed()
 * @mixin \Eloquent
 */
	class QuizQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $identification
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Template[] $templates
 * @property-read int|null $templates_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\SubjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Subject withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subject withoutTrashed()
 * @mixin \Eloquent
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subquestion
 *
 * @property int $id
 * @property string $identification
 * @property int $type_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subquestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subquestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Subquestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subquestion withoutTrashed()
 * @mixin \Eloquent
 */
	class Subquestion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Template
 *
 * @property int $id
 * @property string $identification
 * @property int $subject_id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TemplateFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Query\Builder|Template onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Template withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Template withoutTrashed()
 * @mixin \Eloquent
 */
	class Template extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TemplateQuestion
 *
 * @property int $id
 * @property int $template_id
 * @property int $question_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Template[] $templates
 * @property-read int|null $templates_count
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion newQuery()
 * @method static \Illuminate\Database\Query\Builder|TemplateQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemplateQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TemplateQuestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TemplateQuestion withoutTrashed()
 * @mixin \Eloquent
 */
	class TemplateQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Type
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $identification
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quiz[] $quizzes
 * @property-read int|null $quizzes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subquestion[] $subquestions
 * @property-read int|null $subquestions_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Query\Builder|Type onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Type withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Type withoutTrashed()
 * @mixin \Eloquent
 */
	class Type extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $identification
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quiz[] $quizzes
 * @property-read int|null $quizzes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Template[] $templates
 * @property-read int|null $templates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Type[] $types
 * @property-read int|null $types_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}
