<?php

namespace App\Filament\Resources\TransaksiDarahResource\Pages;

use App\Filament\Resources\TransaksiDarahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiDarahs extends ListRecords
{
    protected static string $resource = TransaksiDarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
