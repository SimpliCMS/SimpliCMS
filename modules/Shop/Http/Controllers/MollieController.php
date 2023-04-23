<?php

declare(strict_types=1);

namespace Modules\Shop\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Core\Http\Controllers\Controller;
use Vanilo\Payment\Models\Payment;
use Vanilo\Payment\PaymentGateways;
use Vanilo\Payment\Processing\PaymentResponseHandler;

class MollieController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function return(string $paymentId) {
        $payment = Payment::findByPaymentId($paymentId);

        if (!$payment) {
            abort(404);
        }

        return view('shop::payment.return', [
            'payment' => $payment,
            'order' => $payment->getPayable(),
        ]);
    }

    public function webhook(Request $request) {
        Log::debug('Mollie webhook:', $request->toArray());

        $response = PaymentGateways::make('mollie')->processPaymentResponse($request->input('id'));
        $payment = Payment::findByPaymentId($response->getPaymentId());

        if (!$payment) {
            return new ModelNotFoundException('Could not locate payment with id ' . $response->getPaymentId());
        }

        $handler = new PaymentResponseHandler($payment, $response);
        $handler->writeResponseToHistory();
        $handler->updatePayment();
        $handler->fireEvents();

        return new Response();
    }

}
