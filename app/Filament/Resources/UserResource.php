<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        // Left: Account Info
                        Section::make('Informasi Akun')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('username')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique(ignoreRecord: true),
                                
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                TextInput::make('password')
                                    ->password()
                                    ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser)
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->confirmed()
                                    ->minLength(8),

                                TextInput::make('password_confirmation')
                                    ->password()
                                    ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser)
                                    ->visible(fn ($livewire) => $livewire instanceof Pages\CreateUser || $livewire instanceof Pages\EditUser)
                                    ->dehydrated(false),

                                Select::make('role')
                                    ->options([
                                        'user' => 'User',
                                        'admin' => 'Admin',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),

                        // Right: Biodata
                        Section::make('Biodata Lengkap')
                            ->columnSpan(2)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Nama Lengkap')
                                            ->required()
                                            ->maxLength(50),
                                        
                                        TextInput::make('nik')
                                            ->label('NIK')
                                            ->maxLength(16)
                                            ->numeric(),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        Select::make('gender')
                                            ->label('Jenis Kelamin')
                                            ->options([
                                                'laki-laki' => 'Laki-laki',
                                                'perempuan' => 'Perempuan',
                                            ])
                                            ->native(false),

                                        Forms\Components\DatePicker::make('birth_date')
                                            ->label('Tanggal Lahir'),
                                    ]),

                                TextInput::make('phone')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->maxLength(15),

                                TextInput::make('address')
                                    ->label('Alamat')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (User $record): string => $record->email),

                TextColumn::make('username')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('role')
                    ->colors([
                        'primary' => 'user',
                        'danger' => 'admin',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('gender')
                    ->label('Gender')
                    ->formatStateUsing(fn (?string $state): string => $state ? ucfirst($state) : '-'),

                TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
