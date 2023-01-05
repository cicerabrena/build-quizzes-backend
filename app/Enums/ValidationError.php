<?php

namespace App\Enums;

enum ValidationError: string
{
    case PASSWORD_INCORRECT = 'The password is incorrect';
    case TOKEN_INVALID = 'The token is not valid.';
    case USER_NOT_REGISTERED = 'The user is not registered.';
    case UUID_NOT_VALID = 'The uuid is not valid.';
    case EMPTY_UUID = 'The uuid is empty.';
    case EMAIL_ALREADY_REGISTERED  = 'The e-mail is already registered.';
}