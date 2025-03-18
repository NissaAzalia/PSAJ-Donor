<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public function view(): string
    {
        return 'filament.pages.dashboard';
    }

    // protected static ?string $navigationIcon = 'heroicon-o-home';
    // protected static ?string $navigationLabel = 'Dashboard Utama'; // Ubah label agar lebih jelas
    // protected static ?int $navigationSort = 1;

    // protected static string $view = 'filament.pages.dashboard';
}
