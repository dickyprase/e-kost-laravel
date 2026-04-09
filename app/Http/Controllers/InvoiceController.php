<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $booking = Booking::with(['user', 'room', 'payment'])->findOrFail($id);

        $pdf = Pdf::loadView('invoices.template', compact('booking'));
        return $pdf->stream('invoice-'.$booking->id.'.pdf');
    }
}
