<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    public static function canCreate(): bool
    {
        // Hanya boleh ada satu settings
        return Setting::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kontak')
                    ->description('Atur informasi kontak yang tampil di halaman About Us.')
                    ->schema([
                        TextInput::make('whatsapp')
                            ->label('Nomor WhatsApp')
                            ->helperText('Format: 628xxxxxxxxxx')
                            ->tel()
                            ->required()
                            ->maxLength(20),

                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Integrasi Peta')
                    ->schema([
                        Textarea::make('maps_embed')
                            ->label('Embed Code Google Maps')
                            ->rows(5)
                            ->hint('Copy iframe src dari Google Maps -> Share -> Embed a map')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('whatsapp')
                    ->label('WhatsApp Admin')
                    ->icon('heroicon-o-chat-bubble-left-right'),
                
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->alamat),

                TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y, H:i'),
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
