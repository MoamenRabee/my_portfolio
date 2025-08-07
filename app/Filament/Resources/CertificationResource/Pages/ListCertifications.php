<?php

namespace App\Filament\Resources\CertificationResource\Pages;

use App\Filament\Resources\CertificationResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListCertifications extends ListRecords
{
    protected static string $resource = CertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('Certifications');
    }
}
