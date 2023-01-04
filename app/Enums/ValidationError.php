<?php

namespace App\Enums;

enum ValidationError: string
{
    case PASSWORD_INCORRECT = 'The password is incorrect';
    case TOKEN_INVALID = 'The token is not valid.';
    case USER_NOT_REGISTERED = 'The user is not registered.';
}