<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Http\RedirectResponse;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CategoryResource;
use App\Filament\CreateRecordAndRedirectToIndex;
class CreateCategory extends CreateRecordAndRedirectToIndex
{
    protected static string $resource = CategoryResource::class;
}
