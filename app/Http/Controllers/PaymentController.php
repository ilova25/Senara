<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

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
        $notif = new Notification();
        $payment = Payment::where('order_id', $notif->order_id)->first();

        if (!$payment) return;

        $status = $notif->transaction_status;

        if ($status == 'settlement') {
            $payment->update([
                'status_pembayaran' => 'paid',
                'transaction_id' => $notif->transaction_id,
                'metode_pembayaran' => $notif->payment_type
            ]);
        } elseif ($status == 'pending') {
            $payment->update(['status_pembayaran' => 'pending']);
        } elseif ($status == 'expire') {
            $payment->update(['status_pembayaran' => 'expired']);
        } else {
            $payment->update(['status_pembayaran' => 'failed']);
        }
    }


}
