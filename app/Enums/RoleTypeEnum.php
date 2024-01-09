<?php

namespace App\Enums;

enum RoleTypeEnum: string
{
    case ADMIN = 'admin';
    case SELLER = 'seller';
    case VENDOR = 'vendor';
    case WRITER = 'writer';
    case OPERATOR = 'operator';
}
