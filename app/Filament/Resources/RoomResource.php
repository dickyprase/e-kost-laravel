<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        // Left Column: Basic Info
                        Section::make('Informasi Dasar')
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('room_name')
                                    ->label('Nama Kamar')
                                    ->required()
                                    ->maxLength(50)
                                    ->placeholder('Contoh: Kamar Melati 01'),

                                Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('room_number')
                                            ->label('Nomor Kamar')
                                            ->required()
                                            ->maxLength(50),
                                        
                                        Forms\Components\Select::make('category_id')
                                            ->label('Kategori')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(50),
                                            ])
                                            ->required(),
                                    ]),

                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(4)
                                    ->required()
                                    ->maxLength(65535),
                            ]),

                        // Right Column: Status & Image
                        Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                Section::make('Status & Harga')
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->label('Harga Bulanan')
                                            ->required()
                                            ->numeric()
                                            ->prefix('Rp'),
                                        
                                        Forms\Components\Select::make('status')
                                            ->label('Status Ketersediaan')
                                            ->options([
                                                'ready' => 'Tersedia',
                                                'not_ready' => 'Tidak Tersedia',
                                            ])
                                            ->required()
                                            ->native(false),
                                    ]),

                                Section::make('Gambar')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Foto Kamar')
                                            ->image()
                                            ->disk('public')
                                            ->directory('room-images')
                                            ->imageEditor()
                                            ->imagePreviewHeight('200')
                                            ->nullable(),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->size(50),

                Tables\Columns\TextColumn::make('room_name')
                    ->label('Nama Kamar')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (Room $record): string => "No: {$record->room_number}"),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ready' => 'Tersedia',
                        'not_ready' => 'Penuh',
                    })
                    ->colors([
                        'success' => 'ready',
                        'danger' => 'not_ready',
                    ]),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'ready' => 'Tersedia',
                        'not_ready' => 'Penuh',
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
