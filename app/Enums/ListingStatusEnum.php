<?php

namespace App\Enums;

enum ListingStatusEnum: string
{
    case NEW = 'new';
    case ACTIVE = 'active';
    case EXPIRE = 'expire';
    case SOLD = 'sold';
}
