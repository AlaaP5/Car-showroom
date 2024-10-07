<?php

namespace App\Enums;

enum TripCases: string
{
    case InWay = 'inWay';
    case Completed = 'completed';
    case Pending = 'pending';
    case Full = 'full';
}
