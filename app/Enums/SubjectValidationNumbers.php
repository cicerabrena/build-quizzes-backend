<?php

namespace App\Enums;

enum SubjectValidationNumbers: int
{
    case MIN_LENGTH_NAME = 5;
    case MAX_LENGTH_DESCRIPTION_NAME = 30;
    case MAX_LENGTH_SLUG = 10;
}