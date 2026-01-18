<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        try {
            // LOG callback
            Log::info('MIDTRANS CALLBACK', $request->all());
            
            // Midtrans config
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Deteksi mode testing (dari Postman) atau real (dari Midtrans)
            $isTestMode = $request->has('test') || !$request->has('transaction_id');

            if ($isTestMode) {
                // MODE TESTING - Manual data
                Log::info('TEST MODE ACTIVATED');
                
                return response()->json([
                    'status' => 'ok',
                    'mode' => 'test',
                    'message' => 'Test callback received successfully',
                    'data' => $request->all()
                ], 200);
            }

            // MODE PRODUCTION - Real Midtrans callback
            $notif = new Notification();

            Log::info('Notification Object', [
                'order_id' => $notif->order_id,
                'transaction_status' => $notif->transaction_status,
                'transaction_id' => $notif->transaction_id,
                'payment_type' => $notif->payment_type,
            ]);

            // Cari payment berdasarkan order_id
            $payment = Payment::where('order_id', $notif->order_id)->first();

            if (!$payment) {
                Log::warning('Payment not found', ['order_id' => $notif->order_id]);
                return response()->json([
                    'message' => 'Payment not found'
                ], 404);
            }

            // Simpan data dasar
            $payment->transaction_id = $notif->transaction_id;
            $payment->metode_pembayaran = $notif->payment_type;
            $payment->gross_amount = (int) $notif->gross_amount;

            // Handle berbagai status transaksi
            switch ($notif->transaction_status) {
                case 'capture':
                    if ($notif->fraud_status === 'accept') {
                        $this->updatePaymentStatus($payment, 'paid');
                    }
                    break;

                case 'settlement':
                    $this->updatePaymentStatus($payment, 'paid');
                    break;

                case 'pending':
                    // JANGAN downgrade dari paid
                    if ($payment->status_pembayaran !== 'paid') {
                        $this->updatePaymentStatus($payment, 'pending');
                    }
                    break;

                case 'deny':
                    $this->updatePaymentStatus($payment, 'failed');
                    break;

                case 'cancel':
                    $this->updatePaymentStatus($payment, 'canceled');
                    break;

                case 'expire':
                    $this->updatePaymentStatus($payment, 'expired');
                    break;

                default:
                    Log::warning('Unknown transaction status', [
                        'status' => $notif->transaction_status,
                        'order_id' => $notif->order_id
                    ]);
                    break;
            }

            Log::info('Payment updated successfully', [
                'order_id' => $payment->order_id,
                'status' => $payment->status_pembayaran
            ]);

            return response()->json(['status' => 'ok'], 200);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function updatePaymentStatus(Payment $payment, string $status): void
    {
        // STOP jika sudah paid
        if ($payment->status_pembayaran === 'paid') {
            Log::info('Payment already paid, skipping update', [
                'order_id' => $payment->order_id
            ]);
            return;
        }

        $payment->status_pembayaran = $status;
        $payment->save();

        Log::info('Payment status updated', [
            'order_id' => $payment->order_id,
            'new_status' => $status
        ]);

        // Sinkron ke booking
        if ($status === 'paid' && $payment->booking) {
            $payment->booking->update([
                'status' => 'paid'
            ]);
            
            Log::info('Booking status synced', [
                'booking_id' => $payment->booking->id,
                'order_id' => $payment->order_id
            ]);
        }
    }
}