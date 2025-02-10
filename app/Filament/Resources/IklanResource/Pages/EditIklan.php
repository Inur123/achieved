<?php

namespace App\Filament\Resources\IklanResource\Pages;

use App\Filament\Resources\IklanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIklan extends EditRecord
{
    protected static string $resource = IklanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return static::$resource::getUrl('index'); // Use getUrl instead of generateUrl
    }
}
