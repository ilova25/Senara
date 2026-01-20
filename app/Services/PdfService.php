<?php

namespace App\Services;

use App\Models\booking;
use App\Models\payment;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    private function ensureTempDirectory(): void
    {
        $dir = storage_path('app/temp');

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    public function generateBookingProof(booking $booking): string
    {
        $this->ensureTempDirectory();

        $filename = 'bukti_reservasi_' . $booking->kode_booking . '.pdf';
        $path = storage_path('app/temp/' . $filename);

        $pdf = Pdf::loadView('pdf.bukti_reservasi', compact('booking'));
        $pdf->save($path);

        return $path;
    }

    public function generatePaymentProof(booking $booking, payment $payment): string
    {
        $this->ensureTempDirectory();

        $filename = 'bukti_pembayaran_' . $booking->kode_booking . '.pdf';
        $path = storage_path('app/temp/' . $filename);
        $pdf = Pdf::loadView('pdf.bukti_pembayaran', compact('booking', 'payment'));

        $pdf->save($path);

        return $path;
    }
}
