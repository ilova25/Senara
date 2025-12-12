<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

use function Symfony\Component\Clock\now;

class PaymentController extends Controller
{
    public function paymentMidtrans($id)
    {
        $booking = Booking::with('unit','user')->findOrFail($id);

         // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = false; // sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'ORDER-' . $booking->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $booking->id . '-' . time(),
                'gross_amount' => $booking->total_harga,
            ],
            'customer_details' => [
                'first_name' => $booking->nama,
                'email' => $booking->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        $payment = payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'order_id' => $orderId,
                'gross_amount' => $booking->total_harga,
                'snap_token' => $snapToken,
                'status_pembayaran' => 'pending'
            ]
        );

        return response()->json(['token' => $snapToken]);
    }

    public function notification(Request $request)
    {
        // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // sandbox

        $notif = new Notification();
        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;

        $payment = Payment::where('order_id', $orderId)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Set data umum
        $payment->transaction_id      = $notif->transaction_id;
        $payment->metode_pembayaran   = $type;
        $payment->gross_amount        = $notif->gross_amount;

        if ($transaction == 'capture') {
            if ($fraud == 'accept') {
                $this->updatePaymentStatus($payment, 'paid', $notif);
            } 
        } else if ($transaction == 'cancel') {
            $this->updatePaymentStatus($payment, 'canceled', $notif);
        } else if ($transaction == 'deny') {
            $this->updatePaymentStatus($payment, 'failed', $notif);
        } else if ($transaction == 'settlement') {
            $this->updatePaymentStatus($payment, 'paid', $notif);
        }
    }

    protected function updatePaymentStatus(payment $payment, string $status, $notif) {
        $payment->status_pembayaran = $status;
        $payment->save();

        if ($status == 'paid') {
            $payment->booking->update([
                'status' => 'paid'
            ]);
        }
    }

}
