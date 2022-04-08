<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function verify(Request $request, $id)
    {
        $model = Order::find($id);
        $payablePrice = $model->amount;
        $payment = new Payment((string)$payablePrice);
        $result = $payment->verifyPayment((string)$request->Authority, $request->Status);
        if ($result) {
            $order = Order::findOrfail($id);
            $order->status = '1';
            $order->save();
            $newPayment = new Payment((string)$payablePrice);
            $newPayment->authority = $request->Authority;
            $newPayment->status = $request->Status;
            $newPayment->RefId = $result->RefID;
            $newPayment->order_id = $id;
            $newPayment->save();
            //cleaning basket of user:
            $baskets = Basket::where('user_id', Auth::id())->get();
            foreach ($baskets as  $b) {
                $b->delete();
            }
            \Illuminate\Support\Facades\Session::flash('payment-success', "پرداخت شما با موفقیت انجام شد!");
        } else {
            \Illuminate\Support\Facades\Session::flash('payment-error', "در پرداخت شما مشکل پیش آمد دوباره تلاش نمایید!");
        }
        return redirect()->to('/checkOut');
    }
}
