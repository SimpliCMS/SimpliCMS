<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Core\Http\Controllers\Controller;
use Vanilo\Payment\Models\Payment;
use Vanilo\Payment\PaymentGateways;
use Vanilo\Payment\Processing\PaymentResponseHandler;

class SimplepayReturnController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function return(Request $request) {
        $response = PaymentGateways::make('simplepay')->processFrontendPaymentResponse($request);
        $payment = Payment::findByPaymentId($response->getPaymentId());

        if (!$payment) {
            return new ModelNotFoundException('Could not locate payment with id ' . $response->getPaymentId());
        }

        return view('shop::payment.return', [
            'response' => $response,
            'payment' => $payment,
            'order' => $payment->getPayable(),
        ]);
    }

    public function silent(Request $request) {
        Log::debug('SimplePay confirmation', $request->toArray());

        $response = PaymentGateways::make('simplepay')->processPaymentResponse($request);
        $payment = Payment::findByPaymentId($response->getPaymentId());

        if (!$payment) {
            return new ModelNotFoundException('Could not locate payment with id ' . $response->getPaymentId());
        }

        $handler = new PaymentResponseHandler($payment, $response);
        $handler->writeResponseToHistory();
        $handler->updatePayment();
        $handler->fireEvents();

        return $response->displayIpnConfirmation();
    }

}
