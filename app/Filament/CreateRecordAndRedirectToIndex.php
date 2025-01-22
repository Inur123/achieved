<?php

namespace App\Filament;

use Filament\Resources\Pages\CreateRecord;

class CreateRecordAndRedirectToIndex extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman index dari resource
        return static::$resource::getUrl('index');
    }
}
