<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Bank')
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->label('Logo Bank')
                            ->disk('public')
                            ->directory('bank-logos')
                            ->imagePreviewHeight('100')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->required(),
                        
                        TextInput::make('bank_name')
                            ->label('Nama Bank')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Contoh: BCA, Mandiri'),
                        
                        TextInput::make('number')
                            ->label('Nomor Rekening')
                            ->required()
                            ->numeric()
                            ->maxLength(20),
                        
                        TextInput::make('name')
                            ->label('Atas Nama')
                            ->required()
                            ->maxLength(50),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->circular()
                    ->size(40),
                
                TextColumn::make('bank_name')
                    ->label('Nama Bank')
                    ->searchable()
                    ->weight('bold'),
                
                TextColumn::make('number')
                    ->label('No. Rekening')
                    ->copyable()
                    ->copyMessage('Nomor rekening disalin')
                    ->searchable(),
                
                TextColumn::make('name')
                    ->label('Atas Nama')
                    ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}
