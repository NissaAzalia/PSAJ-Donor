<?php

namespace App\Filament\Resources\RiwayatPermintaanResource\Pages;

use App\Filament\Resources\RiwayatPermintaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatPermintaan extends EditRecord
{
    protected static string $resource = RiwayatPermintaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
