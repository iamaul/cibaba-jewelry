<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;

class CheckoutController extends Controller
{
    /**
     * Global requests.
     *
     * @return \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.shop.checkout')->with([
            'products' => Product::orderBy('created_at', 'desc')->get(),
            'categories' => Category::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {   
        \DB::transaction(function() {
            $order = Transaction::create([
                'billing_firstname' => $this->request->firstname,
                'billing_lastname' => $this->request->lastname,
                'billing_country' => $this->request->country,
                'billing_address' => $this->request->address,
                'billing_address_alt' => $this->request->address_alt,
                'billing_city' => $this->request->city,
                'billing_postcode' => $this->request->postcode,
                'billing_phone' => $this->request->phone,
                'billing_email' => $this->request->email,
		'billing_subtotal' => 0,
                'billing_total' => 0
            ]);

            $items = Cart::content();
            $item_details = array();
            foreach($items as $item)
            {
                $item_details[] = array(
                    'id'            => $item->id,
                    'price'         => $item->price,
                    'quantity'      => $item->qty,
                    'name'          => $item->name,
                    'merchant_name' => 'Cibaba Jewelry',
                );

                $order->billing_subtotal = $item->subtotal;
                $order->billing_total = $order->billing_subtotal;
            }

            $transaction_details = array(
                'order_id' => 'CIBABA#'.strtoupper(uniqid()).$order->id,
                'gross_amount' => $order->billing_total
            );

            $billing_address = array(
                'first_name'    => $order->billing_firstname,
                'last_name'     => $order->billing_lastname,
                'address'       => $order->billing_address,
                'city'          => $order->billing_city,
                'postal_code'   => $order->billing_postcode,
                'phone'         => $order->billing_phone
            );

            $shipping_address = array(
                'first_name'    => $order->billing_firstname,
                'last_name'     => $order->billing_lastname,
                'address'       => $order->billing_address,
                'city'          => $order->billing_city,
                'postal_code'   => $order->billing_postcode,
                'phone'         => $order->billing_phone
            );

            $customer_details = array(
                'first_name'            => $order->billing_firstname,
                'last_name'             => $order->billing_lastname,
                'email'                 => $order->billing_email,
                'phone'                 => $order->billing_phone,
                'billing_address'       => $billing_address,
                'shipping_address'      => $shipping_address
            );

            $payload = array(
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details
            );
            
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $order->snap_token = $snapToken;
            $order->save();
 
            $this->response['snap_token'] = $snapToken;
            Cart::instance('default')->destroy();
        });
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     * 
     * @return void
     */
    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        \DB::transaction(function() use($notif) {
 
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;
            $order = Transaction::findOrFail($orderId);
 
            if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {

                    if($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        // $order->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                        $order->setStatus('challenge');
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        // $order->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                        $order->setSuccess($type);
                    }
                }
 
            } else if ($transaction == 'settlement') {
                // TODO set payment status in merchant's database to 'Settlement'
                // $order->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
                $order->setSuccess($type);
            } else if($transaction == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                // $order->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
                $order->setStatus('pending');
            } else if ($transaction == 'deny') {
                // TODO set payment status in merchant's database to 'Failed'
                // $order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
                $order->setStatus('deny');
            } else if ($transaction == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                // $order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
                $order->setStatus('expire');
            } else if ($transaction == 'cancel') {
                // TODO set payment status in merchant's database to 'Failed'
                // $order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
                $order->setStatus('cancel');
            }
        });
        return;
    }
}
