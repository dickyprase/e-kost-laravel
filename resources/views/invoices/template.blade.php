{{-- resources/views/invoices/template.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        td, th { border: 1px solid #ddd; padding: 8px; }
        .header { margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Invoice Booking #{{ $booking->id }}</h2>
        <p><strong>Tanggal:</strong> {{ $booking->created_at->format('d M Y') }}</p>
    </div>

    <h4>Data Penyewa:</h4>
    <p>Nama: {{ $booking->user->name }}</p>
    <p>Email: {{ $booking->user->email }}</p>

    <h4>Detail Booking:</h4>
    <table>
        <tr>
            <th>Nama Kamar</th>
            <th>Durasi Sewa</th>
            <th>Nominal Tagihan</th>
        </tr>
        <tr>
            <td>{{ $booking->room->room_name ?? '-' }}</td>
            <td>{{ $booking->durasi_sewa }} bulan</td>
            <td>Rp {{ number_format($booking->nominal_tagihan, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h4>Status Pembayaran:</h4>
    @if($booking->payment)
        <p>Status: <strong>{{ ucfirst($booking->payment->validasi) }}</strong></p>
        <p>Nominal Dibayar: Rp {{ number_format($booking->payment->nominal_dibayar, 0, ',', '.') }}</p>
        <p>Tanggal Bayar: {{ \Carbon\Carbon::parse($booking->payment->tanggal_pembayaran)->format('d M Y H:i') }}</p>
    @else
        <p><em>Belum ada pembayaran.</em></p>
    @endif

    <br><br>
    <p><small>Terima kasih telah melakukan booking.</small></p>
</body>
</html>
