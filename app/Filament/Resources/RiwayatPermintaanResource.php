<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatPermintaanResource\Pages;
use App\Filament\Resources\RiwayatPermintaanResource\RelationManagers;
use App\Models\RiwayatPermintaan;
use App\Models\StokDarah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class RiwayatPermintaanResource extends Resource
{
    protected static ?string $model = RiwayatPermintaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';
    protected static ?int $navigationSort = 4;
    // protected static ?string $label = 'Riwayat Permintaan'; // Nama yang muncul di sidebar

    protected static ?string $pluralLabel = 'Riwayat Permintaan'; // Untuk bentuk jamak


    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('pihak_pemohon')
                        ->label('Pihak Pemohon')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('golongan_darah')
                        ->label('Golongan Darah')
                        ->options(fn () => DB::table('transaksi_darahs')
                            ->select('golongan_darah')
                            ->whereIn('golongan_darah', ['A', 'B', 'AB', 'O']) // Golongan darah yang tersedia
                            ->groupBy('golongan_darah')
                            ->pluck('golongan_darah', 'golongan_darah')
                            ->toArray()) // Konversi ke array agar bisa digunakan Filament
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => 
                            $set('stok_tersedia', DB::table('transaksi_darahs')
                                ->where('golongan_darah', $state)
                                ->count() // Hitung jumlah stok dari transaksi darah
                            ?? 0)
                        ),

                    Forms\Components\TextInput::make('stok_tersedia')
                        ->label('Stok Tersedia')
                        ->numeric()
                        ->default(0)
                        ->disabled(), // Tidak bisa diubah oleh pengguna

                    Forms\Components\TextInput::make('jumlah_kantong')
                        ->label('Jumlah Kantong')
                        ->numeric()
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $stokTersedia = (int) $get('stok_tersedia');

                            if ($state > $stokTersedia) {
                                $set('jumlah_kantong', $stokTersedia); // Auto-set ke stok yang tersedia

                                Notification::make()
                                    ->title('Stok Tidak Cukup')
                                    ->danger()
                                    ->body("Jumlah permintaan melebihi stok yang tersedia ($stokTersedia kantong).")
                                    ->send();
                            }
                        }),
                ])
                        ->columns(3),
        ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pihak_pemohon')
                ->label('Pihak Pemohon')
                ->sortable()
                ->searchable(),

                TextColumn::make('golongan_darah')
                    ->label('Golongan Darah')
                    ->sortable(),

                TextColumn::make('jumlah_kantong')
                    ->label('Jumlah Kantong')
                    ->sortable(),
            ])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayatPermintaans::route('/'),
            'create' => Pages\CreateRiwayatPermintaan::route('/create'),
            'edit' => Pages\EditRiwayatPermintaan::route('/{record}/edit'),
        ];
    }
}
