<?php

use App\Enums\SubjectValidationNumbers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->uuid('identification')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value)->unique();
            $table->string('description', SubjectValidationNumbers::MAX_LENGTH_DESCRIPTION_NAME->value)->nullable();
            $table->string('slug', SubjectValidationNumbers::MAX_LENGTH_SLUG->value)->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
