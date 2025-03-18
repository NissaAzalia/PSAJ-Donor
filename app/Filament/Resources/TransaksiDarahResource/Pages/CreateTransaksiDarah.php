<?php

namespace App\Filament\Resources\TransaksiDarahResource\Pages;

use App\Filament\Resources\TransaksiDarahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaksiDarah extends CreateRecord
{
    protected static string $resource = TransaksiDarahResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect ke daftar transaksi
    }
}
