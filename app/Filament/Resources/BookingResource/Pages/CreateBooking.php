<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Booking;
use App\Models\Room;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;


}
