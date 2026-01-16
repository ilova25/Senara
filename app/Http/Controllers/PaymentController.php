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
    // public function paymentMidtrans($id)
    // {
    //     $booking = Booking::with('unit','user')->findOrFail($id);

    //      // Midtrans Config
    //     Config::$serverKey = config('midtrans.server_key');
    //     Config::$clientKey = config('midtrans.client_key');
    //     Config::$isProduction = false; // sandbox
    //     Config::$isSanitized = true;
    //     Config::$is3ds = true;

    //     $orderId = 'ORDER-' . $booking->id . '-' . time();

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $orderId,
    //             'gross_amount' => $booking->total_harga,
    //         ],
    //         'customer_details' => [
    //             'first_name' => $booking->nama,
    //             'email' => $booking->email,
    //         ]
    //     ];

    //     $snapToken = Snap::getSnapToken($params);

    //     $payment = payment::updateOrCreate(
    //         ['booking_id' => $booking->id],
    //         [
    //             'order_id' => $orderId,
    //             'gross_amount' => $booking->total_harga,
    //             'snap_token' => $snapToken,
    //             'status_pembayaran' => 'pending'
    //         ]
    //     );

    //     return response()->json(['token' => $snapToken]);
    // }

    public function notification(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;

        $notif = new Notification();

        $payment = Payment::where('order_id', $notif->order_id)->first();
        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Simpan data umum
        $payment->transaction_id = $notif->transaction_id;
        $payment->metode_pembayaran = $notif->payment_type;
        $payment->gross_amount = $notif->gross_amount;

        switch ($notif->transaction_status) {
            case 'capture':
                if ($notif->fraud_status == 'accept') {
                    $this->updatePaymentStatus($payment, 'paid', $notif);
                }
                break;

            case 'settlement':
                $this->updatePaymentStatus($payment, 'paid', $notif);
                break;

            case 'pending':
                $this->updatePaymentStatus($payment, 'pending', $notif);
                break;

            case 'deny':
                $this->updatePaymentStatus($payment, 'failed', $notif);
                break;

            case 'cancel':
                $this->updatePaymentStatus($payment, 'canceled', $notif);
                break;

            case 'expire':
                $this->updatePaymentStatus($payment, 'expired', $notif);
                break;
        }

        return response()->json(['status' => 'ok'], 200);
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
