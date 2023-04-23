<?php

declare(strict_types=1);

namespace Modules\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Vanilo\Payment\Models\Payment;
use Vanilo\Payment\PaymentGateways;
use Vanilo\Payment\Processing\PaymentResponseHandler;

class BraintreeController extends Controller {

    public function submit(Request $request, string $paymentId) {
        $gateway = PaymentGateways::make('braintree');
        $payment = Payment::findByPaymentId($paymentId);

        if (!$payment) {
            abort(404);
        }

        $response = $gateway->processPaymentResponse(
                $gateway->createTransaction($payment, $request->input('nonce'))
        );

        $handler = new PaymentResponseHandler($payment, $response);
        $handler->writeResponseToHistory();
        $handler->updatePayment();
        $handler->fireEvents();

        return view('shop::payment.return', [
            'payment' => $payment,
            'order' => $payment->getPayable(),
        ]);
    }

}
