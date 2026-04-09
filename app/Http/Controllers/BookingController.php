<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting; 

class BookingController extends Controller
{
    


    public function show($id)
    {
        $room = Room::findOrFail($id);
        $banks = Bank::all();
        
        return view('rooms.show', compact('room', 'banks'));
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'durasi_sewa' => 'required|integer|min:1|max:12',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Ambil informasi kamar
        $room = Room::findOrFail($request->room_id);
        
        // Hitung nominal tagihan
        $nominalTagihan = $room->price * $request->durasi_sewa;
        
        // Buat pesanan
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'durasi_sewa' => $request->durasi_sewa,
            'nominal_tagihan' => $nominalTagihan,
        ]);
        
        // Upload bukti pembayaran
        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        
        // Buat pembayaran
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'nominal_dibayar' => $nominalTagihan,
            'bukti_pembayaran' => $buktiPath,
            'tanggal_pembayaran' => now(),
            'validasi' => 'pending',
        ]);

        // === Notifikasi WA otomatis ke admin ===
        $adminNumber = Setting::first()->whatsapp; // ambil nomor dari setting
        $adminNumber = preg_replace('/^0/', '62', $adminNumber); // ganti 0 jadi 62

        $message = "🏢 *EKOS NOTIFICATION* 🏢\n\n"
    . "📋 *PESANAN BARU DITERIMA!* 📋\n\n"
    . "👤 *Pemesan:* _" . Auth::user()->name . "_\n"
    . "🏠 *Kamar:* _" . $room->room_name . "_\n"
    . "⏱️ *Durasi Sewa:* _" . $request->durasi_sewa . " bulan_\n"
    . "💰 *Total Tagihan:* _Rp " . number_format($nominalTagihan, 0, ',', '.') . "_\n\n"
    . "```Terima kasih telah menggunakan layanan kami!```\n\n"
    . "🔔 #EkosSystem " . date('d/m/Y H:i') . " 🔔";

        $msg = urlencode($message);
        $secretkey = env('WHATSAPP_API_SECRET');
        $url = "https://wa.nux.my.id/api/sendWA?to={$adminNumber}&msg={$msg}&secret={$secretkey}";
        // Kirim notifikasi via file_get_contents
        try {
            file_get_contents($url);
        } catch (\Exception $e) {
            \Log::error('Gagal kirim WA: ' . $e->getMessage());
        }
        
        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('bookings.index')->with('success', 'Pesanan berhasil dibuat dan menunggu validasi pembayaran.');
    }
    
    // Menampilkan daftar pesanan pengguna
    public function index()
    {
        $bookings = Booking::with(['room', 'payment'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pesanan.index', compact('bookings'));
    }
    
    // Menampilkan detail pesanan
    public function detail($id)
    {
        $booking = Booking::with(['room', 'payment', 'user'])
                   ->where('id', $id)
                   ->where('user_id', Auth::id())
                   ->firstOrFail();
        
        return view('pesanan.show', compact('booking'));
    }
}