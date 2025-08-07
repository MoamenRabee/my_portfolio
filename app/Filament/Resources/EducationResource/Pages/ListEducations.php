<?php

namespace App\Filament\Resources\EducationResource\Pages;

use App\Filament\Resources\EducationResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListEducations extends ListRecords
{
    protected static string $resource = EducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('filament.Education');
    }
}
