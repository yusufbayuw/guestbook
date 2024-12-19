<?php

namespace App\Models;

use App\Observers\GuestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(GuestObserver::class)]
class Guest extends Model
{
    //
}
