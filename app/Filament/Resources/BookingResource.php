<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\Grid as InfoGrid;
use Filament\Tables\Actions\Action;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Data Pesanan';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Manajemen Pesanan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Section::make('Data Pesanan')
                            ->columnSpan(1)
                            ->schema([
                                Select::make('user_id')
                                    ->label('Pelanggan')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->native(false),

                                Select::make('room_id')
                                    ->label('Kamar')
                                    ->relationship('room', 'room_name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->native(false),
                            ]),

                        Section::make('Rincian Sewa')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('durasi_sewa')
                                    ->label('Durasi (Bulan)')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(24)
                                    ->suffix('Bulan'),

                                TextInput::make('nominal_tagihan')
                                    ->label('Total Tagihan')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Tgl Pesan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Booking $record) => $record->user->email ?? '-'),

                TextColumn::make('room.room_name')
                    ->label('Kamar')
                    ->searchable()
                    ->description(fn (Booking $record) => "No: " . ($record->room->room_number ?? '-')),

                TextColumn::make('durasi_sewa')
                    ->label('Durasi')
                    ->formatStateUsing(fn ($state) => $state . ' Bulan'),

                TextColumn::make('nominal_tagihan')
                    ->label('Tagihan')
                    ->money('IDR')
                    ->sortable(),

                BadgeColumn::make('payment.validasi')
                    ->label('Status Pembayaran')
                    ->colors([
                        'secondary' => fn ($state) => $state === null,
                        'warning' => 'pending',
                        'success' => 'valid',
                        'danger' => 'invalid',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'valid' => 'Valid',
                        'pending' => 'Pending',
                        'invalid' => 'Invalid',
                        default => 'Belum Bayar',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('validasi')
                    ->label('Status Pembayaran')
                    ->relationship('payment', 'validasi')
                    ->options([
                        'valid' => 'Terverifikasi',
                        'pending' => 'Menunggu',
                        'invalid' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-text')
                    ->url(fn ($record) => route('invoice.show', $record->id))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->payment?->validasi === 'valid'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->label('Export Excel'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make('Detail Pesanan')
                    ->schema([
                        InfoGrid::make(3)
                            ->schema([
                                TextEntry::make('created_at')->label('Tanggal')->dateTime('d M Y'),
                                TextEntry::make('user.name')->label('Nama Pelanggan'),
                                TextEntry::make('user.phone')->label('No. Telepon'),
                            ]),
                        
                        InfoGrid::make(3)
                            ->schema([
                                TextEntry::make('room.room_name')->label('Kamar'),
                                TextEntry::make('durasi_sewa')->label('Durasi')->suffix(' Bulan'),
                                TextEntry::make('nominal_tagihan')->label('Total Tagihan')->money('IDR'),
                            ]),
                    ]),

                InfoSection::make('Status Pembayaran')
                    ->schema([
                        TextEntry::make('payment.validasi')
                            ->label('Status')
                            ->badge()
                            ->colors([
                                'success' => 'valid',
                                'warning' => 'pending',
                                'danger' => 'invalid',
                            ])
                            ->placeholder('Belum ada data pembayaran'),
                        
                        TextEntry::make('payment.tanggal_pembayaran')
                            ->label('Tgl Bayar')
                            ->dateTime('d M Y')
                            ->placeholder('-'),
                            
                        TextEntry::make('payment.nominal_dibayar')
                            ->label('Jml Dibayar')
                            ->money('IDR')
                            ->placeholder('-'),
                    ])->columns(3),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
        ];
    }
}