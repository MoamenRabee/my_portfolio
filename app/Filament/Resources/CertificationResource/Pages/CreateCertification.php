<?php

namespace App\Filament\Resources\CertificationResource\Pages;

use App\Filament\Resources\CertificationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCertification extends CreateRecord
{
    protected static string $resource = CertificationResource::class;

    public function getTitle(): string
    {
        return __('Create Certification');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
