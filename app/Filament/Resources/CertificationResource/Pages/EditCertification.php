<?php

namespace App\Filament\Resources\CertificationResource\Pages;

use App\Filament\Resources\CertificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCertification extends EditRecord
{
    protected static string $resource = CertificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('Edit Certification');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
