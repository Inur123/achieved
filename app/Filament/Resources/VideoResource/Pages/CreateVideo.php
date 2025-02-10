<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\CreateRecordAndRedirectToIndex;

class CreateVideo extends CreateRecordAndRedirectToIndex
{
    protected static string $resource = VideoResource::class;
}
