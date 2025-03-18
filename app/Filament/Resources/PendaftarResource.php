<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftarResource\Pages;
use App\Filament\Resources\PendaftarResource\RelationManagers;
use App\Models\Pendaftar;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendaftarResource extends Resource
{
    protected static ?string $model = Pendaftar::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;
    protected static ?string $pluralLabel = 'Pendaftar'; // Untuk bentuk jamak


    public static function canCreate(): bool
    {
        return false; // Mencegah tombol "New Stok Darah" muncul
    }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             TextInput::make('nama')->required(),
    //             TextInput::make('umur')->numeric()->required(),
    //             Select::make('jenis_kelamin')
    //                 ->options([
    //                     'Laki-laki' => 'Laki-laki',
    //                     'Perempuan' => 'Perempuan',
    //                 ])
    //                 ->required(),
    //             Select::make('golongan_darah')
    //                 ->options([
    //                     'A' => 'A',
    //                     'B' => 'B',
    //                     'AB' => 'AB',
    //                     'O' => 'O',
    //                 ])
    //                 ->required(),
    //             TextInput::make('nohp')->required(),
    //             Textarea::make('riwayat_kesehatan')->required(),

                    
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('umur')->sortable(),
                TextColumn::make('golongan_darah')->sortable(),
                TextColumn::make('riwayat_kesehatan')->limit(30),

                // Kolom Status (Cek di tabel transaksi_darahs)
                TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn ($record) => $record->transaksiDarah()->exists() ? 'Selesai' : 'Belum')
                    ->badge()
                    ->colors([
                        'success' => 'Selesai',
                        'danger' => 'Belum',
                    ]),

            ])
            ->filters([
                //
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
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
            'index' => Pages\ListPendaftars::route('/'),
            'create' => Pages\CreatePendaftar::route('/create'),
            'edit' => Pages\EditPendaftar::route('/{record}/edit'),
        ];
    }
}
