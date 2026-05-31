<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    /**
     * Handle Midtrans HTTP notification callback (webhook).
     */
    public function webhook(Request $request)
    {
        // Set Midtrans Configuration
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-6nC_P4H9h7Bvx1ZqI-Uj10nJ');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            // Fallback to manual payload parsing (useful for testing or direct requests)
            $payload = json_decode($request->getContent(), true);
            if (!$payload) {
                return response()->json(['message' => 'Invalid payload'], 400);
            }
            $notif = (object) $payload;
        }

        $orderId = $notif->order_id ?? null;
        $transaction = $notif->transaction_status ?? null;
        $fraud = $notif->fraud_status ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Order ID not found'], 400);
        }

        $order = Order::where('order_code', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        Log::info("Midtrans Webhook: Order ID {$orderId}, Status: {$transaction}, Fraud: {$fraud}");

        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                $order->update(['status' => 'menunggu']);
            } else if ($fraud == 'accept') {
                $order->update(['status' => 'diproses']);
                if ($order->user) {
                    $order->user->logActivity("Pembayaran berhasil untuk pesanan: {$orderId}");
                }
            }
        } else if ($transaction == 'settlement') {
            $order->update(['status' => 'diproses']);
            if ($order->user) {
                $order->user->logActivity("Pembayaran berhasil untuk pesanan: {$orderId}");
            }
        } else if ($transaction == 'pending') {
            $order->update(['status' => 'menunggu']);
        } else if (in_array($transaction, ['deny', 'expire', 'cancel'])) {
            $order->update(['status' => 'dibatalkan']);
            if ($order->user) {
                $order->user->logActivity("Pesanan dibatalkan/pembayaran gagal: {$orderId}");
            }
        }

        return response()->json(['message' => 'Webhook processed successfully']);
    }
}
