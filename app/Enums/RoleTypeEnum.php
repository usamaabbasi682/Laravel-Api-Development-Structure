<?php

namespace App\Enums;

enum RoleTypeEnum : string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case STAFF = 'staff';
}
