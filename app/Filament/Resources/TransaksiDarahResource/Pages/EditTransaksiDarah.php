<?php

namespace App\Filament\Resources\TransaksiDarahResource\Pages;

use App\Filament\Resources\TransaksiDarahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiDarah extends EditRecord
{
    protected static string $resource = TransaksiDarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
