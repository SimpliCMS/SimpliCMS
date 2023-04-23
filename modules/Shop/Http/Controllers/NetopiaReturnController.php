<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Core\Http\Controllers\Controller;
use Vanilo\Netopia\Http\Responses\ErrorResponseToNetopia;
use Vanilo\Netopia\Http\Responses\SuccessResponseToNetopia;
use Vanilo\Payment\Models\Payment;
use Vanilo\Payment\PaymentGateways;
use Vanilo\Payment\Processing\PaymentResponseHandler;

class NetopiaReturnController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function return(Request $request) {
        $payment = Payment::findByPaymentId($request->get('orderId'));

        return view('shop::payment.return', [
            'payment' => $payment,
            'order' => $payment->getPayable(),
        ]);
    }

    public function confirm(Request $request) {
        Log::debug('Netopia confirmation', $request->toArray());

        $response = PaymentGateways::make('netopia')->processPaymentResponse($request);
        $payment = Payment::findByPaymentId($response->getPaymentId());

        if (!$payment) {
            return new ErrorResponseToNetopia(404, 'Could not locate payment with id ' . $response->getPaymentId());
        }

        $handler = new PaymentResponseHandler($payment, $response);
        $handler->writeResponseToHistory();
        $handler->updatePayment();
        $handler->fireEvents();

        return new SuccessResponseToNetopia();
    }

}
