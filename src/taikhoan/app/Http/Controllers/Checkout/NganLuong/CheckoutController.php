<?php
namespace App\Http\Controllers\Checkout\NganLuong;

use App\Models\Backend\Transaction;
use App\Models\PageActive;
use App\Models\CheckoutTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NLCheckout;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class CheckoutController extends Controller
{
    /**
     * @param Request $request
     * @param $checkoutInfo truyền vào thông tin người thanh toán
     * Bao gồm: array chứa key: txh_name (tên khách hàng)
     * txh_email (email kh)
     * txh_phone (sđt)
     * txh_gia (số tiền thanh toán)
     */
    public function postCheckout(Request $request)
    {
        if ($request->txt_gia < 20000) {
            Flash::error('Nạp tối thiểu là 20.000 ');
            return redirect('/donate');
        }

        $newOrder = new CheckoutTransaction();
        $newOrder->username = Auth::user()->name;
        $newOrder->amount = $request->txt_gia;
        $newOrder->checkout_type = 'NGANLUONG';
        $newOrder->status = 0;
        $newOrder->save();

        $infoCheckout = $request;
        $receiver = config('checkout.NGANLUONG_RECEIVER');
        //Mã đơn hàng
        $order_code = $newOrder->id;
        //Khai báo url trả về
        $return_url = route('checkoutNl.success');
        // Link nut hủy đơn hàng
        $cancel_url = env('APP_URL');
        //Giá của cả giỏ hàng
        $price = $request->txt_gia;
        //Thông tin giao dịch
        $transaction_info = $order_code;

        $currency = "vnd";
        $quantity = 1;
        $tax = 0;
        $discount = 0;
        $fee_cal = 0;
        $fee_shipping = 0;
        $order_description = $order_code;

        // Sửa thông tin người mua hàng tại đây
        $buyer_info = Auth::user()->name;
        $affiliate_code = "";

        //Khai báo đối tượng của lớp NL_Checkout
        $nl = new NLCheckout();
        $nl->nganluong_url = config('checkout.NGANLUONG_URL');
        $nl->merchant_site_code = config('checkout.NGANLUONG_MERCHANT_ID');
        $nl->secure_pass = config('checkout.NGANLUONG_MERCHANT_PASS');


        $url = $nl->buildCheckoutUrlExpand($return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount, $fee_cal, $fee_shipping, $order_description, $buyer_info, $affiliate_code);
        if ($order_code != "") {
            //một số tham số lưu ý
            //&cancel_url=http://yourdomain.com --> Link bấm nút hủy giao dịch
            //&option_payment=bank_online --> Mặc định forcus vào phương thức Ngân Hàng
            $url .= '&cancel_url=' . $cancel_url;
            //$url .= '&option_payment=bank_online';
            return redirect($url);
            //&lang=en --> Ngôn ngữ hiển thị google translate
        }
        Flash::error('Payment Failed.');
        return redirect('/home');
    }

    public function success(Request $request)
    {
        $transaction_info = $request->transaction_info;
        $order_code = $request->order_code;
        $price = $request->price;
        $payment_id = $request->payment_id;
        $payment_type = $request->payment_type;
        $error_text = $request->error_text;
        $secure_code = $request->secure_code;

        //Khai báo đối tượng của lớp NL_Checkout
        $nl = new NLCheckout();
        $nl->merchant_site_code = config('checkout.NGANLUONG_MERCHANT_ID');
        $nl->secure_pass = config('checkout.NGANLUONG_MERCHANT_PASS');

        //Tạo link thanh toán đến nganluong.vn
        $checkpay = $nl->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);

        if ($checkpay) {
            $checkResult = $nl->GetTransactionDetails($order_code);
            $checkResult = json_decode($checkResult);
            if ($checkResult !== false) {
                $transaction = CheckoutTransaction::where('id', explode('_', $order_code)[1])->first();
                if ($transaction != null && $checkResult->error_code == "00" && (!isset($transaction->token) || $transaction->token != $request->token)) {
                    $transaction->token = $request->token;
                    $transaction->status = 1;
                    //$transaction->transaction_id = $checkResult->data->transaction_id;
                    $transaction->save();
                }
            };
            Flash::success('Payment Success.');
            return redirect('/home');
        } else {
            Flash::error('Payment Failed.');
            return redirect()->to('home');
        }
    }
}

