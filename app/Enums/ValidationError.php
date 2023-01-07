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

    case SUBJECT_NOT_VALID = 'The subject is not valid.';
    case SUBJECT_NAME_ALREADY_REGISTERED = 'The name of the subject is already registered.';
    case SUBJECT_SLUG_ALREADY_REGISTERED = 'The slug of the subject is already registered.';
}