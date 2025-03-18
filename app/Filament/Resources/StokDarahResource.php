<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokDarahResource\Pages;
use App\Filament\Resources\StokDarahResource\RelationManagers;
use App\Models\StokDarah;
use App\Models\TransaksiDarah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class StokDarahResource extends Resource
{
    protected static ?string $model = StokDarah::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 3;
    protected static ?string $pluralLabel = 'Stok Darah'; // Untuk bentuk jamak


    public static function canCreate(): bool
    {
        return false; // Mencegah tombol "New Stok Darah" muncul
    }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             //
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\TransaksiDarah::query()
                ->rightJoin(DB::raw("(SELECT 'A' AS golongan_darah UNION ALL SELECT 'B' UNION ALL SELECT 'AB' UNION ALL SELECT 'O') as golongan"), 
                            'transaksi_darahs.golongan_darah', '=', 'golongan.golongan_darah')
                ->selectRaw("golongan.golongan_darah, COALESCE(COUNT(transaksi_darahs.id), 0) as stok, '' as id")
                ->groupBy('golongan.golongan_darah')
            )
        
        

            ->columns([
                Tables\Columns\TextColumn::make('golongan_darah')
                    ->label('Golongan Darah')
                    ->sortable(),
                    // ->searchable(),

                Tables\Columns\TextColumn::make('stok')
                    ->label('Jumlah Stok')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status Ketersediaan')
                    ->colors([
                        'success' => fn ($record) => $record->stok > 20, // 20+ = Aman
                        'warning' => fn ($record) => $record->stok >= 10 && $record->stok <= 20, // 10-20 = Menipis
                        'danger' => fn ($record) => $record->stok >= 1 && $record->stok < 10, // 1-9 = Kritis
                        'gray' => fn ($record) => $record->stok == 0, // 0 = Kosong
                    ])
                    ->getStateUsing(fn ($record) => match (true) {
                        $record->stok > 20 => 'Aman',
                        $record->stok >= 10 && $record->stok <= 20 => 'Menipis',
                        $record->stok >= 1 && $record->stok < 10 => 'Kritis',
                        default => 'Kosong',                
                    }),
                

            ])
            // ->filters([
            //     Tables\Filters\SelectFilter::make('golongan_darah')
            //         ->label('Filter Golongan Darah')
            //         ->options([
            //             'A' => 'A',
            //             'B' => 'B',
            //             'AB' => 'AB',
            //             'O' => 'O',
            //         ]),
            // ])
            
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ;
    }

    // public static function getRelations(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStokDarahs::route('/'),
           
        ];
    }
}
