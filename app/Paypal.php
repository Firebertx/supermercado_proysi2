<?php
namespace App;

use App\ShoppingCart;
use Anouar\Paypalpayment\PaypalPayment;

class Paypal
{
    private $_apiContext;
    private $shopping_cart;
    private $_ClienteId = 'AQ5mfkJ0F12Q9JCzObyZffOrV9dPerxC2cadLBDMrFRHQAG0tTdoABX63X6XDwpn48pZze262snU4P1i';
    private $_ClienteSecret = 'EGwEa-ZkkCgXFMw38yx4k3yAJeVXW9xb661rs1Fo10KlM7egfA34bQnchrzozrS1j3-G-kdx2oCCP3ky';

    public function __construct($shopping_cart)
    {
        $this->_apiContext=\PaypalPayment::ApiContext($this->_ClienteId,
            $this->_ClienteSecret);

        $config=config("paypal_payment");
        $flatConfig=array_dot($config);

        $this->_apiContext->setConfig($flatConfig);

        $this->shopping_cart=$shopping_cart;
    }

    public function generate()
    {
        $payment=\PaypalPayment::payment()->setIntent("sale")
            ->setPayer($this->payer())
            ->setTransactions([$this->transaction()])
            ->setRedirectUrls($this->redirectURLs());
        try{
            $payment->create($this->_apiContext);
        }catch (\Exception $ex){
            dd($ex);
            exit(1);
        }
        return $payment;
    }

    public function payer()
    {
        return \PaypalPayment::payer()
            ->setPaymentMethod("paypal");
    }

    public function redirectURLs()
    {
        $baseURL=url('/');
        return \PaypalPayment::redirectUrls()
            ->setReturnUrl("$baseURL/payments/store")
            ->setCancelUrl("$baseURL/paypal");
    }

    public function amount()
    {
        return \PaypalPayment::amount()->setCurrency("USD")
            ->setTotal($this->shopping_cart->totalUSD());
    }

    public function transaction()
    {
        return \PaypalPayment::transaction()
            ->setAmount($this->amount())
            ->setItemList($this->items())
            ->setDescription("Tu compra")
            ->setInvoiceNumber(uniqid());
    }

    public function items()
    {
        $items=[];
        $products=$this->shopping_cart->products()->get();
        $packages=$this->shopping_cart->packages()->get();
        foreach ($products as $product){
            array_push($items, $product->paypalItem());

        }
        foreach ($packages as $package){
            array_push($items, $package->paypalItem());
        }
        return \PaypalPayment::itemList()->setItems($items);
    }

    public function execute($paymentId, $payerId){
        $payment=\PaypalPayment::getById($paymentId, $this->_apiContext);

        $execution=\PaypalPayment::PaymentExecution()->setPayerId($payerId);

        return $payment->execute($execution,$this->_apiContext);
    }






}