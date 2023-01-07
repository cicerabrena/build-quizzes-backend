<?php

namespace App\Enums;

enum ValidationNumbers: int
{
    case MIN_LENGTH_NAME = 5;
    case MIN_LENGTH_PASSWORD = 8;
}