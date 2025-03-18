<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiDarahResource\Pages;
use App\Filament\Resources\TransaksiDarahResource\RelationManagers;
use App\Models\Pendaftar;
use App\Models\TransaksiDarah;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiDarahResource extends Resource
{
    protected static ?string $model = TransaksiDarah::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?int $navigationSort = 2;
    protected static ?string $pluralLabel = 'Transaksi Darah'; // Untuk bentuk jamak


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Transaksi')
                ->schema([
                    Select::make('pendaftar_id')
                    ->label('Nama Pendaftar')
                    ->options(fn () => Pendaftar::whereNotIn('id', function ($query) {
                        $query->select('pendaftar_id')->from('transaksi_darahs');
                    })
                    ->whereIn('id', function ($query) {
                        $query->selectRaw('MAX(id)')->from('pendaftar')->groupBy('user_id');
                    })
                    ->pluck('nama', 'id')->toArray())
                    ->searchable()
                    ->required(),


                    DatePicker::make('tanggal')
                        ->label('Tanggal Transaksi')
                        ->required(),
                ])
                ->collapsible() // Tambahkan agar bisa diklik untuk sembunyikan
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pendaftar.nama')
                    ->label('Nama Pendaftar')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal Transaksi')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pendaftar.golongan_darah')
                ->label('Golongan Darah')
                ->sortable()
                ->searchable(),
                
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
            'index' => Pages\ListTransaksiDarahs::route('/'),
            'create' => Pages\CreateTransaksiDarah::route('/create'),
            'edit' => Pages\EditTransaksiDarah::route('/{record}/edit'),
        ];
    }
}
