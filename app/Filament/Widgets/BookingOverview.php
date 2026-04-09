<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingOverview extends BaseWidget
{

    protected function getColumns(): int
    {
        return 2; // Atau 3, 4 sesuai keinginan
    }

    protected function getStats(): array
    {
        // Total pesanan
        $totalBookings = Booking::count();
        
        // Pesanan dengan pembayaran terverifikasi
        $verifiedPayments = Payment::where('validasi', 'valid')->count();
        
        // Pesanan menunggu verifikasi
        $pendingPayments = Payment::where('validasi', 'pending')->count();
        
        // Total pendapatan dari pesanan terverifikasi
        $totalRevenue = Payment::where('validasi', 'valid')
            ->sum('nominal_dibayar');
            
        // Pesanan dalam 7 hari terakhir
        // $recentBookings = Booking::where('created_at', '>=', now()->subDays(7))->count();

        return [
            Stat::make('Total Pesanan', $totalBookings)
                ->description('Semua pesanan dalam sistem')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
                
            Stat::make('Pesanan Terverifikasi', $verifiedPayments)
                ->description('Pembayaran sudah divalidasi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Menunggu Verifikasi', $pendingPayments)
                ->description('Pembayaran belum divalidasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
                
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari pembayaran terverifikasi')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
                
            // Stat::make('Pesanan Baru (7 Hari)', $recentBookings)
            //     ->description('Dalam 7 hari terakhir')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('info'),
        ];
    }
}