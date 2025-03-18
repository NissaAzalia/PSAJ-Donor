<?php

namespace App\Filament\Resources\RiwayatPermintaanResource\Pages;

use App\Filament\Resources\RiwayatPermintaanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\RedirectResponse;

class CreateRiwayatPermintaan extends CreateRecord
{
    protected static string $resource = RiwayatPermintaanResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect ke daftar transaksi
    }

}
