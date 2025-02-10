<?php

namespace App\Filament\Resources\IklanResource\Pages;

use App\Filament\Resources\IklanResource;
use Filament\Actions;

use App\Filament\CreateRecordAndRedirectToIndex;

class CreateIklan extends CreateRecordAndRedirectToIndex
{
    protected static string $resource = IklanResource::class;
}
