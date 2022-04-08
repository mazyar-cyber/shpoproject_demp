<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {



        if (count(Basket::where('user_id', Auth::id())->get()) == 0) {
            \Illuminate\Support\Facades\Session::flash('payment-error', "سبد خرید شما خالی است!");
            return redirect()->back();
        }

        //calc the amount:
        $amount = 0;
        foreach (Basket::where('user_id', Auth::id())->get() as $b) {
            $amount = $amount + $b->price;
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->status = '0';
        $order->amount = $amount;
        $order->save();
        //اینجا باید یک جدول دیگر ایجاد شود و محصولات مربوط به سفارش در آن ذخیره گردد

        $baskets = Basket::where('user_id', Auth::id())->get();
        foreach ($baskets as $b) {
            $model = new ProductOrder();
            $model->order_id = $order->id;
            $model->product_id = $b->product_id;
            $model->save();
        }

        $payment = new Payment((string)$amount, $order->id);
        $result = $payment->doPayment();
        if ($result->Status == 100) {
            return redirect()->to(env('ZarinPalStartPayPath') . $result->Authority);
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }
}
