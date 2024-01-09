<?php

namespace App\Enums;

enum OTPTypeEnum: string
{
    case SIGNUP = 'signup';
    case FORGOT_PASSWORD = 'forgot-password';
}
