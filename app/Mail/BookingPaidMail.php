<?php

namespace App\Mail;

use App\Models\booking;
use App\Models\payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $payment;
    public $bookingProofPath;
    public $paymentProofPath;

    public function __construct(booking $booking, payment $payment, string $bookingProofPath, string $paymentProofPath)
    {
        $this->booking = $booking;
        $this->payment = $payment;
        $this->bookingProofPath = $bookingProofPath;
        $this->paymentProofPath = $paymentProofPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Pembayaran & Booking - ' . $this->booking->kode_booking,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-payment-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->bookingProofPath)
                ->as('bukti_reservasi_' . $this->booking->kode_booking . '.pdf')
                ->withMime('application/pdf'),
            Attachment::fromPath($this->paymentProofPath)
                ->as('bukti_pembayaran_' . $this->payment->order_id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
