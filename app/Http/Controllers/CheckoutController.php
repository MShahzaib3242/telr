<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {
        return view('checkout');
    }

    public function store(Request $request) {
        
        $order_id = rand(4111, 9999);
        $amount = 231;

        $telrManager = new \TelrGateway\TelrManager();

        $billingParams = [
                'first_name' => $request->fname,
                'sur_name' => $request->lname,
                'address_1' => $request->address,
                'address_2' => $request->area,
                'city' => $request->city,
                'zip' => $request->zip,
                'country' => $request->country,
                'email' => $request->email,
            ];

        return $telrManager->pay($order_id, $amount, 'Telr Testing Youtube', $billingParams)->redirect();
    }

    public function success(Request $request) {
        $telrManager = new \TelrGateway\TelrManager();

        $transaction = $telrManager->handleTransactionResponse($request);

        $card_last_4 = $transaction->response['order']['card']['last4'];
        $name = $transaction->response['order']['customer']['name']['forenames']." ".$transaction->response['order']['customer']['name']['surname'];

        return view('success')->with([
            'request'   =>  $request,
            'card_last_4'   =>  $card_last_4,
            'name'  =>  $name,
        ]);
    }
    public function cancel(Request $request) {
        return view(('cancel'));
    }
    public function declined(Request $request) {
        return view(('decline'));
    }
}
