<?php

namespace Tests\Feature\Api;

use App\Enums\SubjectValidationNumbers;
use App\Enums\ValidationError;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCreateASubject(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Ressonância Magnética',
            'description' => 'Descrição padrão.',
            'slug' => 'RM'
        ];

        $response = $this->postJson(uri: route(name: 'api.subjects.store'), data: $data);

        $response->assertCreated()
                ->assertSee('uuid');
    }

    public function testUserCannotCreateSubjectWithInvalidName(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'name' => 'Texto que quebra o limite maximo de caracteres permitidos para o nome.',
            'description' => 'Descrição padrão.',
            'slug' => 'RM'
        ];

        $response = $this->postJson(uri: route(name: 'api.subjects.store'), data: $data);

        $response->assertUnprocessable()
                ->assertSeeText("The name must have max " . SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value . " caracteres.");
    }

    public function testUserCanSeeAllSujectsCreated(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $totalSubjects = 20;

        Subject::factory($totalSubjects)->create();

        $response = $this->getJson(uri: route(name: 'api.subjects.index'));

        $response->assertOk()
                ->assertJsonCount(count: $totalSubjects, key: 'data');
    }

    public function testUserCanSeeInfoOfASubject(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $subject = Subject::factory()->create()->toArray();

        $response = $this->getJson(uri: route(name: 'api.subjects.show', parameters: data_get($subject, 'identification')));

        $response->assertOk()
                ->assertSimilarJson([
                    'uuid' => data_get($subject, 'identification'),
                    'name' => data_get($subject, 'name'),
                    'slug' => data_get($subject, 'slug'),
                    'description' => data_get($subject, 'description'),
                ]);
    }

    public function testUserCannotSeeSubjectWithInvalidUuid(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(uri: route(name: 'api.subjects.show', parameters: 'invalid-uuid'));

        $response->assertNotFound()
                ->assertSeeText(ValidationError::SUBJECT_NOT_VALID->value);
    }

    public function testUserCanUpdateASubject(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $subject = Subject::factory()->create();

        $newData = [
            'name' => 'Suject edited',
            'slug' => 'sj',
            'description' => 'Suject description',
        ];

        $response = $this->putJson(uri: route(name: 'api.subjects.update', parameters: $subject->identification), data: $newData);

        $response->assertOk()
                ->assertSimilarJson([
                    'uuid' => $subject->identification,
                    'name' => data_get($newData, 'name'),
                    'slug' => data_get($newData, 'slug'),
                    'description' => data_get($newData, 'description'),
                ]);
    }

    public function testUserCannotUpdateSubjectWithInvalidUuid(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $newData = [
            'name' => 'Suject edited',
            'slug' => 'sj',
            'description' => 'Suject description',
        ];

        $response = $this->putJson(uri: route(name: 'api.subjects.update', parameters: 'invalid-uuid'), data: $newData);

        $response->assertNotFound()
                ->assertSeeText(ValidationError::SUBJECT_NOT_VALID->value);
    }

    public function testUserCannotUpdateSubjectWithNameDuplicate(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Subject::factory()->create([
            'name' => 'Subject Test',
            'slug' => 'st',
            'description' => 'Suject description'
        ]);

        $subjectToEdited = Subject::factory()->create();

        $newData = [
            'name' => 'Subject Test',
            'slug' => 'sj',
            'description' => 'Suject description',
        ];

        $response = $this->putJson(uri: route(name: 'api.subjects.update', parameters: $subjectToEdited->identification), data: $newData);

        $response->assertUnprocessable()
                ->assertSeeText(ValidationError::SUBJECT_NAME_ALREADY_REGISTERED->value);
    }

    public function testUserCannotUpdateSubjectWithSlugDuplicate(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Subject::factory()->create([
            'name' => 'Subject 1',
            'slug' => 'st',
            'description' => 'Suject description'
        ]);

        $subjectToEdited = Subject::factory()->create();

        $newData = [
            'name' => 'Subject 2',
            'slug' => 'st',
            'description' => 'Suject description',
        ];

        $response = $this->putJson(uri: route(name: 'api.subjects.update', parameters: $subjectToEdited->identification), data: $newData);

        $response->assertUnprocessable()
                ->assertSeeText(ValidationError::SUBJECT_SLUG_ALREADY_REGISTERED->value);
    }

    public function testUserCanDeleteASubject(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $subject = Subject::factory()->create();

        $response = $this->deleteJson(uri: route(name: 'api.subjects.delete', parameters: $subject->identification));

        $response->assertNoContent();
    }

    public function testUserCannotDeleteASubjectWithInvalidUuid(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->deleteJson(uri: route(name: 'api.subjects.delete', parameters: 'invalid-uuid'));

        $response->assertNotFound()
                ->assertSeeText(ValidationError::SUBJECT_NOT_VALID->value);
    }

}