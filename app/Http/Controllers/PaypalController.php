<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use Session;
use Auth;

class PaypalController extends Controller
{

  private $_api_context;

  public function __construct()
  {
    // setup PayPal api context
    $this->middleware('auth');
    $paypal_conf = config('paypal');
    $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
    $this->_api_context->setConfig($paypal_conf['settings']);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'amount' =>'required|integer|min:1'
    ]);

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $item = new Item();
    $item->setName('Library Credits')
      ->setCurrency('INR')
      ->setQuantity(1)
      ->setPrice($request->input('amount'));

    // add item to list
    $item_list = new ItemList();
    $item_list->setItems([$item]);

    $amount = new Amount();
    $amount->setCurrency('INR')
      ->setTotal($request->input('amount'));

    $transaction = new Transaction();
    $transaction->setAmount($amount)
      ->setItemList($item_list)
      ->setDescription('Library Credits');

    $redirect_urls = new RedirectUrls();
    // Specify return & cancel URL
    $redirect_urls->setReturnUrl(url('/payment/paypal/status'))
      ->setCancelUrl(url('/credits'));

    $payment = new Payment();
    $payment->setIntent('Sale')
      ->setPayer($payer)
      ->setRedirectUrls($redirect_urls)
      ->setTransactions(array($transaction));

    try {
      $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
      return redirect('/credits')->with('error', 'Processing Error');
    }

    foreach ($payment->getLinks() as $link) {
      if ($link->getRel() == 'approval_url') {
        $redirect_url = $link->getHref();
        break;
      }
    }

    // add payment ID to session
    Session::put('paypal_payment_id', $payment->getId());

    if (isset($redirect_url)) {
      // redirect to paypal
      return redirect($redirect_url);
    }

    return redirect('/credits')->with('error', 'Unknown error occurred');
  }



  // Paypal process payment after it is done
  public function getPaymentStatus(Request $request)
  {
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');

    // clear the session payment ID
    Session::forget('paypal_payment_id');

    if (empty($request->input('PayerID')) || empty($request->input('token'))) {
      return redirect('/credits')->with('error', 'Payment failed');
    }

    $payment = Payment::get($payment_id, $this->_api_context);

    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($request->input('PayerID'));

    //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);

    if ($result->getState() == 'approved') {
      // Payment is successful do your business logic here
      Auth::User()->credit += $payment->getTransactions()[0]->getAmount()->getTotal();
      Auth::User()->save();
      $item = new \App\Transaction;
      $item->userId = Auth::User()->id;
      $item->credit_change = $payment->getTransactions()[0]->getAmount()->getTotal();
      $item->save();
      return redirect('/credits')->with('success', 'Funds Loaded Successfully!');
    }

    return redirect('/credits')->with('error', 'Payment Failed');
  }
}
