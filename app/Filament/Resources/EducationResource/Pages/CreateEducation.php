<?php

namespace App\Filament\Resources\EducationResource\Pages;

use App\Filament\Resources\EducationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEducation extends CreateRecord
{
    protected static string $resource = EducationResource::class;

    public function getTitle(): string
    {
        return __('filament.Create Education');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
