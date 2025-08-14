<?php

namespace App\Http\Controllers;

use App\Services\PayHeroService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayHeroWebhookController extends Controller
{
    public function handle(Request $request, PayHeroService $payHero)
    {
        if (!$payHero->verifyCallbackToken($request)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->input('response', []);

        Log::info('PayHero Callback', $data);

        $order = Order::where('external_reference', $data['ExternalReference'] ?? null)->first();

        if ($order) {
            if (($data['ResultCode'] ?? 1) === 0) {
                $order->update([
                    'payment_status' => Order::PAYMENT_STATUS_PAID,
                    'status' => Order::STATUS_PROCESSING
                ]);
            } else {
                $order->update([
                    'payment_status' => Order::PAYMENT_STATUS_FAILED
                ]);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
