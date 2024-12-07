<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPayment;
use Illuminate\Http\Request;
use App\Enums\Models\Appointment\PaymentStatus;
use App\Enums\Models\Appointment\StatusType;
use App\Models\Appointment;

class AppointmentPaymentController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\AppointmentPayment  $appointmentPayment
   * @return \Illuminate\Http\Response
   */
  public function show(AppointmentPayment $appointmentPayment)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\AppointmentPayment  $appointmentPayment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, AppointmentPayment $appointmentPayment)
  {
    $validated = $request->validate();

    if ($validated['status'] == PaymentStatus::PAID->value) {
      $appointmentPayment->status = StatusType::CONFIRMED->value;
      $appointmentPayment->save();
    }

    $time = strtotime($appointmentPayment->created_at);

    if ($time < now()->subMinutes(15)->timestamp) {
      $appointmentPayment->status = StatusType::CANCELLED->value;
      $appointmentPayment->appointment->status = StatusType::CANCELLED->value;
      $appointmentPayment->appointment->save();
      $appointmentPayment->save();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\AppointmentPayment  $appointmentPayment
   * @return \Illuminate\Http\Response
   */
  public function destroy(AppointmentPayment $appointmentPayment)
  {
    //
  }

  public function vnpay(AppointmentPayment $appointmentPayment)
  {
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
    $vnp_TmnCode = "U8GMVP78"; //Mã website tại VNPAY 
    $vnp_HashSecret = "VXBN60XDBE9A9KIVSPDTW25MF2AY1KWI"; //Chuỗi bí mật

    $vnp_TxnRef = $appointmentPayment->id;
    $vnp_OrderInfo = $_POST['order_desc'];
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $appointmentPayment->amount * 100;
    $vnp_Locale = "VN";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
      $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return response()->json([
      'url' => $vnp_Url,
      'message' => 'success',
    ]);
    // $returnData = array(
    //   'code' => '00',
    //   'message' => 'success',
    //   'data' => $vnp_Url
    // );
    // if (isset($_POST['redirect'])) {
    //   header('Location: ' . $vnp_Url);
    //   die();
    // } else {
    //   echo json_encode($returnData);
    // }
  }
}
