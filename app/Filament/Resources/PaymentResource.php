<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $modelLabel = 'Pembayaran';

    protected static ?string $pluralModelLabel = 'Data Pembayaran';

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Manajemen Pesanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Section::make('Info Transaksi')
                            ->columnSpan(2)
                            ->schema([
                                Select::make('booking_id')
                                    ->label('Pesanan ID')
                                    ->relationship('booking', 'id')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                
                                Select::make('user_id')
                                    ->label('Pelanggan')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->searchable(),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('nominal_dibayar')
                                            ->label('Jumlah Bayar')
                                            ->required()
                                            ->numeric()
                                            ->prefix('Rp'),

                                        DateTimePicker::make('tanggal_pembayaran')
                                            ->label('Tanggal Transfer')
                                            ->required()
                                            ->default(now()),
                                    ]),
                            ]),
                        
                        Section::make('Bukti & Status')
                            ->columnSpan(1)
                            ->schema([
                                FileUpload::make('bukti_pembayaran')
                                    ->label('Bukti Transfer')
                                    ->image()
                                    ->directory('bukti_pembayaran')
                                    ->visibility('public')
                                    ->imagePreviewHeight('150')
                                    ->required(),

                                Select::make('validasi')
                                    ->label('Status Validasi')
                                    ->options([
                                        'pending' => 'Menunggu',
                                        'valid' => 'Valid',
                                        'invalid' => 'Invalid',
                                    ])
                                    ->default('pending')
                                    ->required()
                                    ->native(false),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.id')
                    ->label('ID Pesanan')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->user->name),

                TextColumn::make('nominal_dibayar')
                    ->label('Nominal')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('tanggal_pembayaran')
                    ->label('Tgl Bayar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                BadgeColumn::make('validasi')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'valid',
                        'danger' => 'invalid',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'valid' => 'Terverifikasi',
                        'pending' => 'Menunggu',
                        'invalid' => 'Ditolak',
                        default => $state,
                    }),

                ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti')
                    ->disk('public')
                    ->circular()
                    ->size(40),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('validasi')
                    ->options([
                        'valid' => 'Valid',
                        'pending' => 'Pending',
                        'invalid' => 'Invalid',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('verifikasi')
                    ->label('Set Valid')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (Payment $record) => $record->validasi === 'pending')
                    ->action(function (Payment $record) {
                        $record->update(['validasi' => 'valid']);
                        if ($record->booking && $record->booking->room) {
                            $record->booking->room->update(['status' => 'not_ready']);
                        }
                        self::sendWhatsAppNotification($record->user->phone, "Pembayaran Valid ID: {$record->id}");
                    }),
                Action::make('tolak')
                    ->label('Set Invalid')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (Payment $record) => $record->validasi === 'pending')
                    ->action(function (Payment $record) {
                        $record->update(['validasi' => 'invalid']);
                        if ($record->booking && $record->booking->room) {
                            $record->booking->room->update(['status' => 'ready']);
                        }
                        self::sendWhatsAppNotification($record->user->phone, "Pembayaran Ditolak ID: {$record->id}");
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function sendWhatsAppNotification(string $phoneNumber, string $message): void
    {
        // Placeholder simple notification logic
    }
    
    public static function getRelations(): array { return []; }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
        ];
    }
}