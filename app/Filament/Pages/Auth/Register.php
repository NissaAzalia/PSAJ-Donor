<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field default
                parent::getNameFormComponent(),
                parent::getEmailFormComponent(),
                parent::getPasswordFormComponent(),
                parent::getPasswordConfirmationFormComponent(),

                // Tambahan field baru
                \Filament\Forms\Components\TextInput::make('umur')
                    ->label('Umur')
                    ->required()
                    ->numeric()
                    ->minValue(1),

                \Filament\Forms\Components\TextInput::make('no_hp')
                    ->label('No HP')
                    ->required(),

                \Filament\Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),
            ]);
    }

    protected function handleRegistration(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'umur' => $data['umur'],
            'no_hp' => $data['no_hp'],
            'jenis_kelamin' => $data['jenis_kelamin'],
        ]);
    }
}
