<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PayInfo;
use App\buy;
use App\User;
use App\Profit;

use App\Http\Requests;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;

use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
	private $_apiConText;
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function contTextpaypal(){
		$this->_apiConText =new ApiContext(
			new OAuthTokenCredential(
				config('paypal_payment.Account.ClientId'),
				config('paypal_payment.Account.ClientSecret')
				));
		$this->_apiConText->setConfig(config('paypal_payment.Setting'));
	}
    public function AddCartItme(Request $request){
    	$price =intval($request->price);
    	$this->contTextpaypal();
    	$payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $amount = new Amount();
         $amount->setCurrency("USD")
         ->setTotal($price);
         $transaction = new Transaction();
          $transaction->setAmount($amount);
          $baseUrl = url('/');
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/DoneCharge?success=true")
    ->setCancelUrl("$baseUrl/ErorrCharage?success=false");
    $payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));
    $request = clone $payment;
    $curl_info =curl_version();
try {
    $payment->create($this->_apiConText);



} catch (PayPalConnectionException $ex) {
	    	         abort(403);

}
        $redirect = null;
        foreach ($payment->getLinks() as $link) {
        if ($link->getRel() == 'approval_url') {
            $redirect=$link->getHref();
        }
        }

        if ($redirect != null) {
                    return redirect()->away($redirect);
        }

    }
    public function GetPaymentInfoById($id){
    		$pay = Payment::get($id ,$this->_apiConText) ;
    return $pay;
    }
 public function DoneCharge(Request $reqest ){
if ($reqest->success== true && $reqest->paymentId && $reqest->token &&$reqest->PayerID) {
    $this->contTextpaypal();
    $info =$this->GetPaymentInfoById($reqest->paymentId);
     //  dd($info);

if ($info->state =='created') {
      $pay = new PayInfo();
    $pay->id_pay= $reqest->paymentId;
    $pay->payment_method= $info->payer->payment_method;
    $pay->state= $info->state;
    $pay->payerID= $reqest->PayerID;
    $pay->price= $info->transactions[0]->amount->total;
    $pay->user_id= Auth::user()->id;
    $pay->save();
      return redirect('/#!/ShowAllCharge');
    }
     abort(403);
    
}

  abort(403);
  
}
  


    
    



public function ErorrCharage(){

      return redirect('/#!/AddCredit');

}


    public function GetAllShowChearg(){
    	$user= Auth::user();
    	$pay=PayInfo::where('user_id',$user->id)->orderBy('id','desc')->get();
    	$sumprice=PayInfo::where('user_id',$user->id)->sum('price');
    	$array =[
    	'user'=>$user,
    	'pay'=>$pay,
    	'sumprice'=>$sumprice
    	];
    	return $array;
    }


    public function ShowAllPay(){
	$user= Auth::user();
    	$buy=buy::where('user_id',$user->id)->orderBy('id','desc')->get();
    	$sumprice=buy::where('user_id',$user->id)->where('finish','!=',2)->sum('buy_price');
    	$array =[
    	'user'=>$user,
    	'buy'=>$buy,
    	'sumprice'=>$sumprice
    	];
    	return $array;

    }
      public function ShowAllProfit(){
	$user= Auth::user();
    	$buy=buy::where('rev_id',$user->id)->where('finish',1)->orderBy('id','desc')->get();
    	$sumprice=buy::where('rev_id',$user->id)->where('finish',1)->sum('buy_price');
    	$array =[
    	'user'=>$user,
    	'buy'=>$buy,
    	'sumprice'=>$sumprice
    	];
    	return $array;

    }

     public function ShowAllBlance(){
    $user= Auth::user();
   	$userProfit=buy::where('rev_id',$user->id)->where('finish',1)->sum('buy_price');
   	$userPay = buy::where('user_id',$user->id)->where('finish','!=',2)->sum('buy_price');
    $userChearhe=PayInfo::where('user_id',$user->id)->sum('price');
            $profitDone = Profit::where('user_id',$user->id)->sum('profit_price');
            $getProfit = Profit::where('user_id',$user->id)->where('status',0)->sum('profit_price');
            $getDoneProfit = Profit::where('user_id',$user->id)->where('status',1)->sum('profit_price');
            $p=$userProfit - $profitDone;
       	 $userChearhe = $userChearhe  >0 ? $userChearhe  :0;
        // $userProfit  = $userProfit   >0 ? $userProfit   :0;
       	 $userPay     = $userPay      >0 ? $userPay      :0;
         $p           = $p            >0 ? $p            :0;
         $getProfit     = $getProfit  >0 ? $getProfit    :0;
         $getDoneProfit = $getDoneProfit >0 ? $getDoneProfit      :0;

         
                 $array =[
                'user'          =>$user,
            	'userProfit'    =>$p,
                'userWaitProfit'=>$getProfit,
                'userDoneProfit'=>$getDoneProfit,
            	'userPay'       =>$userPay,
                'userChearhe'   =>$userChearhe,
                'realProft'     =>$userProfit,


            	];
            	return $array;


     }
     public function Getprofit(Request $request){
        $profit = intval($request->profit);
        $user =Auth::user();

        $buyCheck = buy::where('user_id' ,$user->id)->where('finish','!=',2)->sum('buy_price');
        $pay =PayInfo::where('user_id' ,$user->id)->sum('price');
        $proft = Profit::where('user_id' ,$user->id)->sum('profit_price'); 
        $realProfit=buy::where('rev_id' ,$user->id)->where('finish',1)->sum('buy_price');
        $p= $pay - $buyCheck;
        $prof =$realProfit-$proft;
        if ($p > 0) {
            $canGet=$prof ;
        }else{
            $canGet= ($p - $pay) + $prof;
        }

    
        if($canGet >= 10) {

        if($canGet >=$profit) {
        $payprofit= $profit / 5;
        $prof = new Profit();
        $prof->user_id= $user->id;
        $prof->profit_price= $profit - $payprofit;
        $prof->status= 0;
        $prof->webite_profit=$payprofit;
        $prof->time= time();

            if ($prof->save()) {
          return $profit;
        }

          return  abort(403);

       }
          return  abort(403);
           }
          return  abort(403);
      


     }

  public function RetainedProfits(){
        $user= Auth::user();
            $Profit=Profit::where('user_id',$user->id)->orderBy('id','desc')->get();
            $sumWating=Profit::where('user_id',$user->id)->where('status',0)->sum('profit_price');
            $sumDone=Profit::where('user_id',$user->id)->where('status',1)->sum('profit_price');

            $array =[
            'user'=>$user,
            'Profit'=>$Profit,
            'sumWating'=>$sumWating,
            'sumDone'=>$sumDone

            
            ];
            return $array;

    }

    public function AddSendMoney($id)
        {
           $profit= Profit::findOrFail($id);
           if ($profit) {
               $user =User::findOrFail($profit->user_id);
               if($user){

                  $this->contTextpaypal();
                $payouts = new \PayPal\Api\Payout();
                $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
               $senderBatchHeader->setSenderBatchId(uniqid())
                ->setEmailSubject("shope send you profit.");
                $senderItem3 = new \PayPal\Api\PayoutItem(
            array(
                "recipient_type" => "EMAIL",
                "receiver" => $user->email,
                "note" => "shope send you profit.",
                "sender_item_id" => uniqid(),
                "amount" => array(
                    "value" => $profit->profit_price,
                    "currency" => "USD"
                )

            )
        );

            $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem3);
            $request = clone $payouts;
            try {
            $output = $payouts->createSynchronous($this->_apiConText);
        } catch (Exception $ex) {

            exit(1);
        }

        $payoutItemId = $output->getItems()[0]->getPayoutItemId();

        try {
            $output = \PayPal\Api\PayoutItem::get($payoutItemId, $this->_apiConText);

            if ($output->transaction_status == 'SUCCESS') {
                $profit->status=1;
                $profit->payout_item_id=$output->payout_item_id;
                if($profit->save())
                {
                    return redirect()->back();
                }else{
                    abort(403);
                }
                
            }
        } catch (Exception $ex) {

               abort(403);

        }
                //dd($output);

               }
           }
           
           abort(403);
        }

     
    
}
