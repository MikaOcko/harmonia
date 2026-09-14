<?php

namespace App\Enum;

enum AlbumType: string
{
    case SINGLE = 'single';
    case ALBUM = 'album';
    case EP = 'ep';
}