<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Resources\AuthorResource;
use Filament\Actions;
use App\Filament\CreateRecordAndRedirectToIndex;

class CreateAuthor extends CreateRecordAndRedirectToIndex
{
    protected static string $resource = AuthorResource::class;
}
