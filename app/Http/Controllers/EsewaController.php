<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;

class EsewaController extends Controller
{
    public function pay($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        $transactionUuid = 'ORDER-' . $order->id . '-' . time();

        $productCode = 'EPAYTEST';
        $secretKey = '8gBm/:&EnhH.1/q';

        // Calculate total from order items
        $amountValue = $order->items->sum(function ($item) {
return round((float) $item->price_at_purchase) * (int) $item->quantity;        });

        if ($amountValue <= 0) {
            $amountValue = round((float) $order->total_amount);
        }

        $taxAmountValue = 0;
        $serviceChargeValue = 0;
        $deliveryChargeValue = 0;

        $totalAmountValue = $amountValue + $taxAmountValue + $serviceChargeValue + $deliveryChargeValue;

        $amount = number_format($amountValue, 2, '.', '');
        $taxAmount = number_format($taxAmountValue, 2, '.', '');
        $serviceCharge = number_format($serviceChargeValue, 2, '.', '');
        $deliveryCharge = number_format($deliveryChargeValue, 2, '.', '');
        $totalAmount = number_format($totalAmountValue, 2, '.', '');

        $signedFieldNames = 'total_amount,transaction_uuid,product_code';

        $message = "total_amount={$totalAmount},transaction_uuid={$transactionUuid},product_code={$productCode}";

        $signature = base64_encode(
            hash_hmac('sha256', $message, $secretKey, true)
        );

        $order->update([
            'transaction_uuid' => $transactionUuid,
            'total_amount' => $totalAmount,
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);

        return view('payment.esewa', compact(
            'order',
            'amount',
            'taxAmount',
            'serviceCharge',
            'deliveryCharge',
            'totalAmount',
            'transactionUuid',
            'productCode',
            'signedFieldNames',
            'signature'
        ));
    }

    public function success(Request $request)
    {
        if (!$request->has('data')) {
            return redirect()
                ->route('orders.index')
                ->with('error', 'eSewa did not return payment data.');
        }

        $decodedData = json_decode(base64_decode($request->data), true);

        if (!$decodedData || !isset($decodedData['transaction_uuid'])) {
            return redirect()
                ->route('orders.index')
                ->with('error', 'Invalid eSewa payment response.');
        }

        $order = Order::where('transaction_uuid', $decodedData['transaction_uuid'])->first();

        if (!$order) {
            return redirect()
                ->route('orders.index')
                ->with('error', 'Order not found for this eSewa transaction.');
        }

        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
            'esewa_ref_id' => $decodedData['transaction_code'] ?? null,
        ]);

        Cart::where('user_id', $order->user_id)->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'eSewa payment successful. Order confirmed.');
    }

    public function failure(Request $request)
    {
        $transactionUuid = $request->transaction_uuid ?? null;

        if ($transactionUuid) {
            $order = Order::where('transaction_uuid', $transactionUuid)->first();

            if ($order) {
                $order->update([
                    'payment_status' => 'failed',
                    'order_status' => 'cancelled',
                ]);
            }
        }

        return redirect()
            ->route('orders.index')
            ->with('error', 'eSewa payment failed or was cancelled.');
    }
}